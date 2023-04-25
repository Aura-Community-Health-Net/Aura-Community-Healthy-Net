<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Database;

class CareRiderController  extends Controller
{
    public static function getCareRiderChoosePage(): bool|array|string
{
$nic = $_SESSION["nic"];
$userType = $_SESSION["user_type"];
if (!$nic || $userType !== "consumer")
{
header("location: /provider-login");
return "";
}

else {
    $db = new Database();
    $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
    $stmt->bind_param("s", $nic);
    $stmt->execute();
    $result = $stmt->get_result();
    $consumer = $result->fetch_assoc();

    $stmt = $db->connection->prepare("SELECT * FROM service_provider INNER JOIN care_rider on service_provider.provider_nic = care_rider.provider_nic INNER JOIN vehicle on care_rider.provider_nic = vehicle.provider_nic ");
    $stmt->execute();
    $result = $stmt->get_result();
    $care_rider = $result->fetch_all(MYSQLI_ASSOC);

    //print_r($care_rider);die();
}

return self::render(view: 'consumer-dashboard-services-care-rider', layout: "consumer-dashboard-layout",params: ["care_rider"=>$care_rider], layoutParams: [
    "consumer" => $consumer,
    "care_rider"=>$care_rider,
    "active_link" => "care-rider",
    "title" => "Care Rider"]);
}
    public static function getCareRiderRequestsPage(): bool|array|string
    {
//        print_r($_GET);
        $provider_nic = $_GET['provider_nic'];
        $nic = $_SESSION["nic"];
        $userType = $_SESSION["user_type"];
        if (!$nic || $userType !== "consumer")
        {
            header("location: /provider-login");
            return "";
        }

        else {
            $db = new Database();

            $stmt = $db->connection->prepare("SELECT * FROM service_provider INNER JOIN care_rider on service_provider.provider_nic = care_rider.provider_nic INNER JOIN care_rider_time_slot on care_rider.provider_nic = care_rider_time_slot.provider_nic WHERE service_provider.provider_nic =?");
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
//            if (isset($_GET['feedback-btn'])) {
//                $careRiderFeedback = $_GET['care-rider-feedback'];
//                $feedbackDatetime = $_GET['feedback-datetime'];
//
//                $stmt = $db->connection->prepare("INSERT INTO feedback (
//                      text,
//                      date_time,
//                      provider_nic,
//                      consumer_nic)VALUES (?,?,?,?)");
//                $stmt->bind_param("ssss", $careRiderFeedback, $feedbackDatetime, $provider_nic, $nic);
//                $stmt->execute();
//                $result = $stmt->get_result();
//            }
        }
        return self::render(view: 'consumer-dashboard-services-care-rider-requests', layout: "consumer-dashboard-layout", params:["care_rider"=>$care_rider,"feedback"=>$feedback,"time_slot" =>$time_slot], layoutParams: [
            "consumer" => $consumer,
            "care_rider"=>$care_rider,
            "feedback"=> $feedback,
            "active_link" => "requests",
            "title" => "Care Rider",
           "time_slot" =>$time_slot]);
    }
//    public static function getCareRiderPaymentsPage(): bool|array|string
//    {
//        $nic = $_SESSION["nic"];
//        $userType = $_SESSION["user_type"];
//        if (!$nic || $userType !== "consumer")
//        {
//            header("location: /provider-login");
//            return "";
//        }
//
//        else {
//            $db = new Database();
//            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
//            $stmt->bind_param("s", $nic);
//            $stmt->execute();
//            $result = $stmt->get_result();
//            $consumer = $result->fetch_assoc();
//        }
//
//        return self::render(view: 'consumer-dashboard-care-rider-payment', layout: "consumer-dashboard-layout", layoutParams: [
//            "consumer" => $consumer,
//            "active_link" => "requests",
//            "title" => "Care Rider"]);
//    }

    public static function addConsumerCareRiderFeedback():bool|array|string {

        $provider_nic = $_POST['provider_nic'];
        $feedback_msg = $_POST['feedback-msg'];
        $date_time = $_POST['feedback-datetime'];
        $consumer_nic = $_SESSION["nic"];

        $db = new Database();
        if ($provider_nic && $feedback_msg && $date_time && $consumer_nic){
            $stmt = $db->connection->prepare("INSERT INTO feedback (
                            text, date_time, provider_nic, consumer_nic
                              ) VALUES ( ?, ?, ?, ? )");

            $stmt->bind_param("ssss", $feedback_msg, $date_time, $provider_nic, $consumer_nic);
            $stmt->execute();
            $result = $stmt->get_result();
            header("location: /consumer-dashboard/services/care-rider/request?provider_nic=$provider_nic");
            return "";
        }
        header("location: /consumer-dashboard/services/care-rider/request?provider_nic=$provider_nic");
        return "";

//            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
//            $stmt->bind_param("s", $consumer_nic);
//            $stmt->execute();
//            $result = $stmt->get_result();
//            $consumer = $result->fetch_assoc();
//
//            $stmt = $db->connection->prepare("SELECT * FROM service_provider INNER JOIN care_rider on service_provider.provider_nic = care_rider.provider_nic INNER JOIN vehicle on care_rider.provider_nic = vehicle.provider_nic ");
//            $stmt->execute();
//            $result = $stmt->get_result();
//            $care_rider = $result->fetch_all(MYSQLI_ASSOC);
//
//        $stmt = $db->connection->prepare("SELECT feedback.text, feedback.date_time, service_consumer.profile_picture, service_consumer.name FROM feedback INNER JOIN service_consumer on feedback.consumer_nic = service_consumer.consumer_nic WHERE feedback.provider_nic = ?");
//        $stmt->bind_param("s", $provider_nic);
//        $stmt->execute();
//        $result = $stmt->get_result();
//        $feedback = $result->fetch_all(MYSQLI_ASSOC);
//        return self::render(view: 'consumer-dashboard-services-care-rider-requests', layout: "consumer-dashboard-layout", params:["care_rider"=>$care_rider,"feedback"=>$feedback], layoutParams: [
//                "consumer" => $consumer,
//                "care_rider"=>$care_rider,
//                "feedback"=> $feedback,
//                "active_link" => "requests",
//                "title" => "Care Rider"]);

    }

}