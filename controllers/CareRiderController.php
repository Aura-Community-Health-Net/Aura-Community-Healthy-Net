<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Database;

class CareRiderController extends Controller
{
    //consumer=> get display provider list page
    //consumer-dashboard-services-care-rider-page
    public static function getCareRiderChoosePage(): bool|array|string
    {
        $nic = $_SESSION["nic"];
        $userType = $_SESSION["user_type"];
        if (!$nic || $userType !== "consumer") {
            header("location: /login");
            return "";
        } else {
            $db = new Database();

            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $consumer = $result->fetch_assoc();

            $stmt = $db->connection->prepare("SELECT location_lat,location_lng FROM service_consumer WHERE consumer_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $location_lat = $consumer["location_lat"];
            $location_lng = $consumer["location_lng"];

            $search_query = isset($_GET["q"]) ? $_GET["q"] : "";

            $vehicleType = $_GET["vehicle_type"] ?? "all";

            if ($vehicleType === "all") {
                $stmt = $db->connection->prepare("
                    SELECT * FROM service_provider
                    INNER JOIN care_rider ON service_provider.provider_nic = care_rider.provider_nic
                    AND st_distance_sphere(point(?, ?), point(service_provider.location_lng, service_provider.location_lat)) <= 10000
                    INNER JOIN vehicle ON care_rider.provider_nic = vehicle.provider_nic
                    WHERE is_verified = TRUE AND name LIKE '%$search_query%'
                ");
                $stmt->bind_param("dd", $location_lng, $location_lat);
            } else {
                $stmt = $db->connection->prepare("
                    SELECT * FROM service_provider
                    INNER JOIN care_rider ON service_provider.provider_nic = care_rider.provider_nic
                    AND st_distance_sphere(point(?, ?), point(service_provider.location_lng, service_provider.location_lat)) <= 10000
                    INNER JOIN vehicle ON care_rider.provider_nic = vehicle.provider_nic
                    WHERE  vehicle.type = ? AND is_verified =TRUE AND name LIKE '%$search_query%'
                ");
                $stmt->bind_param("dds", $location_lng, $location_lat, $vehicleType);
            }

            $stmt->execute();
            $result = $stmt->get_result();
            $care_rider = $result->fetch_all(MYSQLI_ASSOC);
        }

        return self::render(
            view: 'consumer-dashboard-services-care-rider',
            layout: "consumer-dashboard-layout",
            params: [
                'consumer' => $consumer,
                "care_rider" => $care_rider,
                'searchTerm' => $search_query,
                "vehicle_type" => $vehicleType
            ],
            layoutParams: [
                "consumer" => $consumer,
                "care_rider" => $care_rider,
                "active_link" => "care-rider",
                "title" => "Care Rider"
            ]
        );
    }




    // counsumer => according to service provider display timeslot, feedback
    //consumer-dashboard-services-care-rider-requests-page
    public static function getCareRiderRequestsPage(): bool|array|string
    {
//        print_r($_GET);
        $provider_nic = $_GET['provider_nic'];
        $nic = $_SESSION["nic"];
        $userType = $_SESSION["user_type"];
        if (!$nic || $userType !== "consumer") {
            header("location: /login");
            return "";
        } else {

            $db = new Database();

            $stmt = $db->connection->prepare("SELECT * FROM service_provider INNER JOIN care_rider on service_provider.provider_nic = care_rider.provider_nic INNER JOIN care_rider_time_slot on care_rider.provider_nic = care_rider_time_slot.provider_nic WHERE service_provider.provider_nic =? && care_rider_time_slot.request_id IS NULL ");
            $stmt->bind_param("s", $provider_nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $time_slot = $result->fetch_all(MYSQLI_ASSOC);


            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $consumer = $result->fetch_assoc();
//            print_r($result);

            $stmt = $db->connection->prepare("SELECT * FROM service_provider INNER JOIN care_rider on service_provider.provider_nic = care_rider.provider_nic INNER JOIN vehicle on care_rider.provider_nic = vehicle.provider_nic WHERE service_provider.provider_nic =?");
            $stmt->bind_param("s", $provider_nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $care_rider = $result->fetch_all(MYSQLI_ASSOC);

            $stmt = $db->connection->prepare("SELECT feedback.text, feedback.date_time, service_consumer.profile_picture, service_consumer.name FROM feedback INNER JOIN service_consumer on feedback.consumer_nic = service_consumer.consumer_nic WHERE feedback.provider_nic = ?");
            $stmt->bind_param("s", $provider_nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $feedback = $result->fetch_all(MYSQLI_ASSOC);
//
        }
        return self::render(view: 'consumer-dashboard-services-care-rider-requests', layout: "consumer-dashboard-layout", params: ["care_rider" => $care_rider, "feedback" => $feedback, "time_slot" => $time_slot], layoutParams: [
            "consumer" => $consumer,
            "care_rider" => $care_rider,
            "feedback" => $feedback,
            "active_link" => "requests",
            "title" => "Care Rider",
            "time_slot" => $time_slot]);
    }
//get request success page
//display distance, cost
    public static function getCareRideRequestSuccessPage(): bool|array|string

    {
        $nic = $_SESSION["nic"];
        $userType = $_SESSION["user_type"];
        if (!$nic || $userType !== "consumer") {
            header("location: /login");
            return "";
        } else {

            $req_id = $_GET['req_id'];
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $service_consumer = $result->fetch_assoc();

            $stmt=$db->connection->prepare("SELECT distance FROM ride_request WHERE consumer_nic =? AND request_id =?");
            $stmt->bind_param("si",$nic,$req_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $success = $result->fetch_assoc();

            //print_r($success);die();

        }

        //print_r($success);
        return self::render(view: '/consumer-dashboard-care-rider-request-success', layout: "consumer-dashboard-layout", params: ["consumer" => $service_consumer,"success"=>$success], layoutParams: [
            "consumer" => $service_consumer,
            "active_link" => "consumer",
            "title" => "Care Rider"]);
    }

    //give the feedback to consumer to providers
    //consumer-dashboard-services-care-rider-requests-page
    public static function addConsumerCareRiderFeedback(): bool|array|string
    {

        $provider_nic = $_POST['provider_nic'];
        $feedback_msg = $_POST['feedback-msg'];
        //$date_time = $_POST['feedback-datetime'];
        $consumer_nic = $_SESSION["nic"];

        $db = new Database();
        if ($provider_nic && $feedback_msg && $consumer_nic) {
            $stmt = $db->connection->prepare("INSERT INTO feedback (
                            text, date_time, provider_nic, consumer_nic
                              ) VALUES ( ?, now(), ?,  ? )");

            $stmt->bind_param("sss", $feedback_msg, $provider_nic, $consumer_nic);
            $stmt->execute();
            $result = $stmt->get_result();
            header("location: /consumer-dashboard/services/care-rider/request?provider_nic=$provider_nic");
            return "";
        }
        header("location: /consumer-dashboard/services/care-rider/request?provider_nic=$provider_nic");
        return "";


    }
// Insert to pickup time and location database
//consumer-dashboard-services-care-rider-requests-page
    public function getConsumerLocation(): bool|array|string
    {
//        print_r($_GET);
        $provider_nic = $_GET['provider_nic'];
        $nic = $_SESSION["nic"];
        $userType = $_SESSION["user_type"];
        if (!$nic || $userType !== "consumer") {
            header("location: /login");
            return "";
        } else {

            $provider_nic = $_GET['provider_nic'];
            $pickup_lat = $_POST['pickup-lat'];
            $pickup_lng = $_POST['pickup-lng'];
            $drop_lat = $_POST['drop-lat'];
            $drop_lng = $_POST['drop-lng'];
            $pickup_time = $_POST['pickup-time'];
            $distance = $_POST['distance'];
            $slot_number = $_POST['available-time-slot'];
            $location1 = json_encode([
                "lat" => $pickup_lat,
                "lng" => $pickup_lng
            ]);

            $location2 = json_encode([
                "lat" => $drop_lat,
                "lng" => $drop_lng
            ]);
            $db = new Database();
            $done = 0;
            $confirmation = 0;
            $cost = $distance * 70 * 100;
//Input to rider-request-data
            $stmt = $db->connection->prepare("INSERT INTO ride_request (time,from_location,to_location,distance,done,confirmation,provider_nic,consumer_nic
                     )VALUES (?,?,?,?,?,?,?,?)");
            $stmt->bind_param("ssssiiss", $pickup_time, $location1, $location2, $distance, $done, $confirmation, $provider_nic, $nic,);
            $stmt->execute();
            $result = $stmt->get_result();

            $req_id = $stmt->insert_id;
            $stmt = $db->connection->prepare("UPDATE care_rider_time_slot SET request_id = ?
                               WHERE slot_number = $slot_number");
            $stmt->bind_param("i", $req_id);
            $stmt->execute();
            $result = $stmt->get_result();

            header("location: /consumer-dashboard/services/care-rider/request/successful?req_id=$req_id");

        }
        return self::render(view: 'consumer-dashboard-care-rider-request-sent', layout: "consumer-dashboard-layout", params: [], layoutParams: [
            "active_link" => "requests",
            "title" => "Care Rider"]);
    }


}