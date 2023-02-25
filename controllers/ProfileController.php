<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Database;



class ProfileController extends Controller
{
    public static function getCareRiderProfilePage(): array|bool|string
    {
        $nic = $_SESSION['nic'];
        $providerType = $_SESSION['user_type'];

        if (!$nic || $providerType != "care-rider") {
            header("location: /provider-login");
            return "";
        }
        $db = new Database();

        $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
        $stmt->bind_param("s", $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        $careRider = $result->fetch_assoc();


        return self::render(view: 'care-rider-dashboard-profile', layout: "care-rider-dashboard-layout", params: [], layoutParams: [
            "active_link" => "Profile",
            "title" => "Profile",
            "care_rider" => $careRider
        ]);
    }
    
    public static function getDoctorProfilePage(): array|bool|string
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$nic || $providerType !== "doctor") {
            header("location: /provider-login");
            return "";
        } else {
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $doctor = $result->fetch_assoc();
        }

        return self::render(view: 'doctor-dashboard-profile', layout: "doctor-dashboard-layout", layoutParams: [
            "doctor" => $doctor,
            "active_link" => "profile",
            "title" => "Profile"
        ]);
    }

    public static function getPharmacyProfilePage(): bool|array|string
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$nic) {
            header("location: /provider-login");
            return "";
        } else {

            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $pharmacy = $result->fetch_assoc();

            return self::render(view: 'pharmacy-dashboard-profile', layout: "pharmacy-dashboard-layout", params: [], layoutParams: [
                "pharmacy" => $pharmacy,
                "title" => "Profile",
                "active_link" => ""
            ]);
        }
    }
    public function getProductSellerProfilePage(): bool|array|string
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$nic || $providerType !== "product-seller") {
            header("location: /provider-login");
            return "";
        } else {
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $product_seller = $result->fetch_assoc();
        }

        return self::render(view: 'product-seller-dashboard-profile', layout: "product-seller-dashboard-layout", layoutParams: [
            "product_seller" => $product_seller,
            "active_link" => "profile",
            "title" => "Profile"
        ]);
    }


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
        }

        return self::render(view: 'consumer-dashboard-service-doctor', layout: "consumer-dashboard-layout", layoutParams: [
            "consumer" => $consumer,
            "active_link" => "profile",
            "title" => "Doctor"
        ]);
    }

    public function getConsumerServicesDoctorProfilePage($id): bool|array|string
    {
        print_r($id);die();
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

        return self::render(view: 'consumer-dashboard-service-doctor-profile', layout: "consumer-dashboard-layout", layoutParams: [
            "consumer" => $consumer,
            "active_link" => "profile",
            "title" => "Doctor"
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

    public function getConsumerProfilePage(): bool|array|string
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

        return self::render(view: 'consumer-dashboard-profile', layout: "consumer-dashboard-layout", layoutParams: [
            "consumer" => $consumer,
            "active_link" => "profile",
            "title" => "Profile"
        ]);
    }

    public function DoctorProfile():bool|array|string
    {
        $nic = $_SESSION['nic'];
        $providerType = $_SESSION['user_type'];

        if (!$nic || $providerType != "doctor") {
            header("location: /provider-login");
            return "";
        }
        $db = new Database();

        $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
        $stmt->bind_param("s", $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        $doctor = $result->fetch_assoc();

        $stmt = $db->connection->prepare("SELECT * FROM doc_qualifications WHERE provider_nic = ?");
        $stmt->bind_param("s", $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        $doctorQualification = $result->fetch_assoc();

        $stmt = $db->connection->prepare("SELECT * FROM doctor WHERE provider_nic = ?");
        $stmt->bind_param("s", $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        $profile = $result->fetch_assoc();


        return self::render(view: 'doctor-dashboard-profile', layout: "doctor-dashboard-layout", params: ['doctor'=>$doctor,'profile'=>$profile,'doctorQualification'=>$doctorQualification], layoutParams: [
            //"doctor" => "doctor",
            "doctorQualification"=>"doctorQualification",
            "profile" => "profile",
            "title" => "Profile",
            "doctor"=>$doctor
        ]);
    }

    public function ConsumerProfile(): bool|array|string
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

        return self::render(view: 'consumer-dashboard-profile', layout: "consumer-dashboard-layout",params: ['consumer'=>$consumer], layoutParams: [
            "consumer" => $consumer,
            "active_link" => "profile",
            "title" => "Profile"
        ]);
    }

    public function ConsumerServicesDoctor(): bool|array|string
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

            //print_r($_GET);
            if(empty($_GET)){
                $stmt = $db->connection->prepare("SELECT * FROM service_provider INNER JOIN doctor on service_provider.provider_nic = doctor.provider_nic");
                $stmt->execute();
                $result = $stmt->get_result();
                $doctor = $result->fetch_all(MYSQLI_ASSOC);
            }else{
                $name = strtoupper($_GET['search']);
                $stmt = $db->connection->prepare("SELECT * FROM service_provider INNER JOIN doctor on service_provider.provider_nic = doctor.provider_nic WHERE name=?");
                $stmt->bind_param("s", $name);
                $stmt->execute();
                $result = $stmt->get_result();
                $doctor = $result->fetch_all(MYSQLI_ASSOC);
            }

        }

        return self::render(view: 'consumer-dashboard-service-doctor', layout: "consumer-dashboard-layout",params: ['consumer'=>$consumer,'doctor'=>$doctor], layoutParams: [
            "consumer" => $consumer,
            "active_link" => "profile",
            "title" => "Profile"
        ]);
    }

    public function ConsumerServicesDoctorProfile(): bool|array|string
    {
        //print_r($_GET);die();
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

            //print_r($time_slot);die();

            $stmt = $db->connection->prepare("SELECT * FROM feedback INNER JOIN service_consumer on feedback.consumer_nic = service_consumer.consumer_nic WHERE feedback.provider_nic = ?");
            $stmt->bind_param("s", $provider_nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $feedback = $result->fetch_all(MYSQLI_ASSOC);

            if (isset($_GET['doctor-feedback-btn'])){
                $doctorFeedback = $_GET['doctor-feedback'];
                $feedbackDatetime = $_GET['feedback-datetime'];

                $stmt = $db->connection->prepare("INSERT INTO feedback (
                      text,
                      date_time,
                      provider_nic,
                      consumer_nic)VALUES (?,now(),?,?)");
                $stmt->bind_param("sss", $doctorFeedback,$provider_nic,$nic);
                $stmt->execute();
                $result = $stmt->get_result();
            }

            //print_r($_GET);

        }

        return self::render(view: 'consumer-dashboard-service-doctor-profile', layout: "consumer-dashboard-layout",params:["consumer"=>$consumer,"doctor"=>$doctor,"time_slot"=>$time_slot,"feedback"=>$feedback] , layoutParams: [
            "consumer" => $consumer,
            "doctor" => $doctor,
            "time_slot" => $time_slot,
            "feedback" => $feedback,
            "active_link" => "profile",
            "title" => "Doctor"
        ]);
    }

    public function ConsumerServicesDoctorProfilePayment(): bool|array|string
    {
        //print_r($_GET);die();
        $provider_nic = $_GET['provider_nic'];
        $consumer_nic = $_GET['consumer_nic'];
        $slot_number = $_GET['available-time-slot'];
        $done = $confirmation = 0;
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

            $stmt = $db->connection->prepare("INSERT INTO appointment (
                      done,
                      confirmation,
                      provider_nic,
                      consumer_nic)VALUES (?,?,?,?)");
            $stmt->bind_param("iiss", $done,$confirmation,$provider_nic,$consumer_nic);
            $stmt->execute();
            $result = $stmt->get_result();

            $result2 = $stmt->insert_id;

            //print_r($appointment);die();
            $appointment_id = $result2;
            $stmt = $db->connection->prepare("UPDATE doctor_time_slot SET appointment_id = ?
                               WHERE slot_number = $slot_number");
            $stmt->bind_param("s",$appointment_id );
            $stmt->execute();
            $result = $stmt->get_result();
        }

        return self::render(view: 'consumer-dashboard-service-doctor-profile-payment', layout: "consumer-dashboard-layout", layoutParams: [
            "consumer" => $consumer,
            "active_link" => "profile",
            "title" => "Doctor"
        ]);
    }
}
