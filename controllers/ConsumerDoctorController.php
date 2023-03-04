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
            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $consumer = $result->fetch_assoc();

                $stmt = $db->connection->prepare("SELECT * FROM service_provider INNER JOIN doctor on service_provider.provider_nic = doctor.provider_nic");
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

    public function ConsumerServicesDoctorFilter(): bool|array|string
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

            $name = strtoupper($_POST['search']);
            $stmt = $db->connection->prepare("SELECT * FROM service_provider INNER JOIN doctor on service_provider.provider_nic = doctor.provider_nic WHERE name=?");
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $result = $stmt->get_result();
            $doctor = $result->fetch_all(MYSQLI_ASSOC);
        }

        return self::render(view: 'consumer-dashboard-service-doctor', layout: "consumer-dashboard-layout", params: ['consumer'=>$consumer,'doctor' => $doctor], layoutParams: [
            'consumer'=>$consumer,
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

            $stmt = $db->connection->prepare("SELECT * FROM service_provider INNER JOIN doctor on service_provider.provider_nic = doctor.provider_nic WHERE service_provider.provider_nic = ?");
            $stmt->bind_param("s", $provider_nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $doctor = $result->fetch_assoc();

            $stmt = $db->connection->prepare("SELECT * FROM doctor_time_slot WHERE provider_nic = ? && appointment_id IS NULL");
            $stmt->bind_param("s", $provider_nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $time_slot = $result->fetch_all(MYSQLI_ASSOC);

            $stmt = $db->connection->prepare("SELECT * FROM feedback INNER JOIN service_consumer on feedback.consumer_nic = service_consumer.consumer_nic WHERE feedback.provider_nic = ?");
            $stmt->bind_param("s", $provider_nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $feedback = $result->fetch_all(MYSQLI_ASSOC);

            //print_r($doctor);
        }
        return self::render(view: 'consumer-dashboard-service-doctor-profile', layout: "consumer-dashboard-layout",params:["consumer"=>$consumer,"doctor"=>$doctor,"time_slot"=>$time_slot,"feedback"=>$feedback] , layoutParams: [
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
            print_r($_POST);
            $done = $confirmation = 0;

            $db = new Database();
            $stmt = $db->connection->prepare("INSERT INTO appointment (
                      done,
                      confirmation,
                      provider_nic,
                      consumer_nic)VALUES (?,?,?,?)");
            $stmt->bind_param("iiss", $done,$confirmation,$provider_nic,$nic);
            $stmt->execute();
            $result = $stmt->get_result();

            $result2 = $stmt->insert_id;
            print_r($result2);
            $appointment_id = $result2;
            $stmt = $db->connection->prepare("UPDATE doctor_time_slot SET appointment_id = ?
                               WHERE slot_number = $slot_number");
            $stmt->bind_param("s",$appointment_id );
            $stmt->execute();
            $result = $stmt->get_result();

            header("location: /consumer-dashboard/services/doctor/profile/payment");
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