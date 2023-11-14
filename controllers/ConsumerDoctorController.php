<?php

namespace app\controllers;

use app\core\Controller;
use app\core\database;

class ConsumerDoctorController extends Controller
{
    public function getConsumerServicesDoctorPage(): bool|array|string
    {
        $nic = $_SESSION["nic"];
        $userType = $_SESSION["user_type"];
        if (!$nic || $userType !== "consumer") {
            header("location: /login");
            return "";
        } else {
            $db = new Database();

            $stmt = $db->connection->prepare("SELECT location_lat, location_lng FROM service_consumer WHERE consumer_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $consumer_location = $result->fetch_assoc();
            $location_lat = $consumer_location["location_lat"];
            $location_lng = $consumer_location["location_lng"];

            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $consumer = $result->fetch_assoc();

            $name = isset($_GET['q'])? $_GET['q']:"";

            if(!$name){
                $stmt = $db->connection->prepare("SELECT * FROM service_provider INNER JOIN doctor on service_provider.provider_nic = doctor.provider_nic AND st_distance_sphere(point(?, ?), point(service_provider.location_lng, service_provider.location_lat)) <= 10000");
                $stmt->bind_param("dd",  $location_lng, $location_lat);
            }else{
                $stmt = $db->connection->prepare("SELECT * FROM service_provider INNER JOIN doctor on service_provider.provider_nic = doctor.provider_nic WHERE name LIKE '%$name%' AND st_distance_sphere(point(?, ?), point(service_provider.location_lng, service_provider.location_lat)) <= 10000");
                $stmt->bind_param("dd",  $location_lng, $location_lat);
            }
            $stmt->execute();
            $result = $stmt->get_result();
            $doctor = $result->fetch_all(MYSQLI_ASSOC);

        }

        return self::render(view: 'consumer-dashboard-service-doctor', layout: "consumer-dashboard-layout",params: ['consumer'=>$consumer,'doctor'=>$doctor], layoutParams: [
            "consumer" => $consumer,
            "active_link" => "profile",
            "title" => "Profile"
        ]);
    }

    public function getConsumerServicesDoctorProfilePage(): bool|array|string
    {
        //print_r($id);die();
        //print_r($_POST['provider_nic']);
        $provider_nic = $_GET['provider_nic'];
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

            $stmt = $db->connection->prepare("SELECT * FROM service_provider JOIN doctor on service_provider.provider_nic = doctor.provider_nic  WHERE service_provider.provider_nic = ?");
            $stmt->bind_param("s", $provider_nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $doctor = $result->fetch_assoc();

            $stmt = $db->connection->prepare("SELECT qualifications FROM doc_qualifications  WHERE provider_nic = ?");
            $stmt->bind_param("s", $provider_nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $doctor_qualifications = $result->fetch_all(MYSQLI_ASSOC);

            $stmt = $db->connection->prepare("SELECT * FROM doctor_time_slot WHERE provider_nic = ? && appointment_id IS NULL");
            $stmt->bind_param("s", $provider_nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $time_slot1 = $result->fetch_all(MYSQLI_ASSOC);

            $stmt = $db->connection->prepare("SELECT * FROM doctor_time_slot JOIN appointment on doctor_time_slot.appointment_id = appointment.appointment_id WHERE doctor_time_slot.provider_nic = ? && appointment.status = 'unpaid'");
            $stmt->bind_param("s", $provider_nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $time_slot2 = $result->fetch_all(MYSQLI_ASSOC);

            $time_slot = array_merge($time_slot1,$time_slot2);
//            print_r($time_slot);die();

            $stmt = $db->connection->prepare("SELECT * FROM feedback INNER JOIN service_consumer on feedback.consumer_nic = service_consumer.consumer_nic WHERE feedback.provider_nic = ?");
            $stmt->bind_param("s", $provider_nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $feedback = $result->fetch_all(MYSQLI_ASSOC);

            //print_r($doctor);
        }
        return self::render(view: 'consumer-dashboard-service-doctor-profile', layout: "consumer-dashboard-layout",params:["consumer"=>$consumer,"doctor"=>$doctor,"time_slot"=>$time_slot,"feedback"=>$feedback,"doctor_qualifications"=>$doctor_qualifications] , layoutParams: [
            "consumer" => $consumer,
            "active_link" => "profile",
            "title" => "Doctor"
        ]);
    }


    public function ConsumerServicesDoctorFeedback(): bool|array|string
    {
        $nic = $_SESSION["nic"];
        $userType = $_SESSION["user_type"];
        if (!$nic || $userType !== "consumer") {
            header("location: /login");
            return "";
        } else {


            $provider_nic = $_GET['provider_nic'];
            $doctorFeedback = $_POST['doctor-feedback'];

            $db = new Database();
                $stmt = $db->connection->prepare("INSERT INTO feedback (
                      text,
                      date_time,
                      provider_nic,
                      consumer_nic)VALUES (?,now(),?,?)");
                $stmt->bind_param("sss", $doctorFeedback,$provider_nic,$nic);
                $stmt->execute();
                $result = $stmt->get_result();
            header("location: /consumer-dashboard/services/doctor/profile?provider_nic=$provider_nic");
        }

        return self::render(view: 'consumer-dashboard-service-doctor-profile', layout: "consumer-dashboard-layout", layoutParams: [
            "active_link" => "profile",
            "title" => "Profile"
        ]);
    }


    public function ConsumerServicesDoctorTimeslot(): bool|array|string
    {
        $nic = $_SESSION["nic"];
        $userType = $_SESSION["user_type"];
        if (!$nic || $userType !== "consumer") {
            header("location: /login");
            return "";
        } else {

            $provider_nic = $_GET['provider_nic'];
            $slot_number = $_POST['available-time-slot'];
            $dest_lat = $_POST['destination-lat'];
            $dest_lng = $_POST['destination-lng'];

            $location = json_encode([
                "lat" => $dest_lat,
                "lng" => $dest_lng
            ]);

            //print_r($_POST);
            $done = 0;


            $db = new Database();

                $stmt = $db->connection->prepare("INSERT INTO appointment (
                      done,
                      provider_nic,
                      consumer_nic, location)VALUES (?,?,?,?)");
                $stmt->bind_param("isss",$done,$provider_nic, $nic, $location);
                $stmt->execute();
                $result = $stmt->get_result();

                $result2 = $stmt->insert_id;
                $appointment_id = $result2;
                $stmt = $db->connection->prepare("UPDATE doctor_time_slot SET appointment_id = ?
                               WHERE slot_number = $slot_number");
                $stmt->bind_param("s",$appointment_id );
                $stmt->execute();
                $result = $stmt->get_result();


            header("location: /consumer-dashboard/services/doctor/profile/payment?appointment_id=$appointment_id");
        }

        return self::render(view: 'consumer-dashboard-service-doctor-profile', layout: "consumer-dashboard-layout", layoutParams: [
            "active_link" => "profile",
            "title" => "Profile"
        ]);
    }

    public function getConsumerServicesDoctorProfilePaymentPage(): bool|array|string
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
        }

        return self::render(view: 'consumer-dashboard-service-doctor-profile-payment', layout: "consumer-dashboard-layout", layoutParams: [
            "consumer" => $consumer,
            "active_link" => "profile",
            "title" => "Doctor"
        ]);
    }
}