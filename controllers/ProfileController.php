<?php

namespace app\controllers;

use app\core\Controller;
use app\core\database;




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
        $care_rider = $result->fetch_assoc();


        return self::render(view: 'care-rider-dashboard-profile', layout: "care-rider-dashboard-layout", params: ["care_rider"=>$care_rider], layoutParams: [
            "active_link" => "Profile",
            "title" => "Profile",
            "care_rider"=>$care_rider,
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

            $stmt = $db->connection->prepare("SELECT * FROM doc_qualifications WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $doctorQualification = $result->fetch_all(MYSQLI_ASSOC);
            //print_r($doctorQualification);

            $stmt = $db->connection->prepare("SELECT * FROM doctor WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $profile = $result->fetch_assoc();
        }

        return self::render(view: 'doctor-dashboard-profile', layout: "doctor-dashboard-layout",params: ['doctor'=>$doctor,'profile'=>$profile,'doctorQualification'=>$doctorQualification], layoutParams: [
            "doctor" => $doctor,
            "active_link" => "profile",
            "title" => "Profile"
        ]);
    }

    public static function getPharmacyProfilePage(): bool|array|string
    {
        $provider_nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$provider_nic || $providerType !== "pharmacy") {
            header("location: /provider-login");
            return "";
        } else {

            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $provider_nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $pharmacy = $result->fetch_assoc();


            $stmt = $db->connection->prepare("SELECT s.name,p.pharmacy_name,p.pharmacist_reg_no,s.email_address,s.mobile_number,s.address,s.profile_picture FROM  service_provider s INNER  JOIN pharmacy p ON s.provider_nic = p.provider_nic WHERE s.provider_nic = ?");
            $stmt->bind_param("s",$provider_nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $pharmacy_details = $result->fetch_all(MYSQLI_ASSOC);

            return self::render(view: 'pharmacy-dashboard-profile', layout: "pharmacy-dashboard-layout", params: [
                'pharmacy' => $pharmacy,
                'pharmacy_details' => $pharmacy_details
            ], layoutParams: [
                'pharmacy' => $pharmacy,
                "active_link" => "profile",
                "title" => "Profile"

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

            $stmt = $db->connection->prepare("SELECT s.profile_picture, s.name, p.business_name, s.email_address, s.provider_nic, s.mobile_number, s.address FROM service_provider s INNER JOIN `healthy_food/natural_medicine_provider` p ON s.provider_nic = p.provider_nic WHERE p.provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $product_seller_view = $result->fetch_assoc();
        }

        return self::render(view: 'product-seller-dashboard-profile', layout: "product-seller-dashboard-layout", params: ['profile_details' => $product_seller_view], layoutParams: [
            "product_seller" => $product_seller,
            "active_link" => "profile",
            "title" => "Profile"
        ]);
    }



//    public function getConsumerServicesDoctorPage(): bool|array|string
//    {
//        $nic = $_SESSION["nic"];
//        $userType = $_SESSION["user_type"];
//        if (!$nic || $userType !== "consumer") {
//            header("location: /login");
//            return "";
//        } else {
//            $db = new Database();
//            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
//            $stmt->bind_param("s", $nic);
//            $stmt->execute();
//            $result = $stmt->get_result();
//            $consumer = $result->fetch_assoc();
//        }
//
//        return self::render(view: 'consumer-dashboard-service-doctor', layout: "consumer-dashboard-layout", layoutParams: [
//            "consumer" => $consumer,
//            "active_link" => "profile",
//            "title" => "Doctor"
//        ]);
//    }
//
//    public function getConsumerServicesDoctorProfilePage(): bool|array|string
//    {
//        $nic = $_SESSION["nic"];
//        $userType = $_SESSION["user_type"];
//        if (!$nic || $userType !== "consumer") {
//            header("location: /login");
//            return "";
//        } else {
//            $db = new Database();
//            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
//            $stmt->bind_param("s", $nic);
//            $stmt->execute();
//            $result = $stmt->get_result();
//            $consumer = $result->fetch_assoc();
//        }
//
//        return self::render(view: 'consumer-dashboard-service-doctor-profile', layout: "consumer-dashboard-layout", layoutParams: [
//            "consumer" => $consumer,
//            "active_link" => "profile",
//            "title" => "Doctor"
//        ]);
//    }
//
//    public function getConsumerServicesDoctorProfilePaymentPage(): bool|array|string
//    {
//        $nic = $_SESSION["nic"];
//        $userType = $_SESSION["user_type"];
//        if (!$nic || $userType !== "consumer") {
//            header("location: /login");
//            return "";
//        } else {
//            $db = new Database();
//            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
//            $stmt->bind_param("s", $nic);
//            $stmt->execute();
//            $result = $stmt->get_result();
//            $consumer = $result->fetch_assoc();
//        }

//        return self::render(view: 'consumer-dashboard-service-doctor-profile-payment', layout: "consumer-dashboard-layout", layoutParams: [
//            "consumer" => $consumer,
//            "active_link" => "profile",
//            "title" => "Doctor"
//        ]);
//    }


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

        return self::render(view: 'consumer-dashboard-profile', layout: "consumer-dashboard-layout",params: ["consumer"=>$consumer], layoutParams: [
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

            $stmt = $db->connection->prepare("SELECT * FROM doctor_time_slot WHERE provider_nic = ?");
            $stmt->bind_param("s", $provider_nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $time_slot = $result->fetch_all(MYSQLI_ASSOC);

            $stmt = $db->connection->prepare("SELECT * FROM feedback INNER JOIN service_consumer on feedback.consumer_nic = service_consumer.consumer_nic WHERE feedback.provider_nic = ?");
            $stmt->bind_param("s", $provider_nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $feedback = $result->fetch_all(MYSQLI_ASSOC);

            if (isset($_GET['feedback-btn'])){
                $doctorFeedback = $_GET['doctor-feedback'];
                $feedbackDatetime = $_GET['feedback-datetime'];

                $stmt = $db->connection->prepare("INSERT INTO feedback (
                      text,
                      date_time,
                      provider_nic,
                      consumer_nic)VALUES (?,?,?,?)");
                $stmt->bind_param("ssss", $doctorFeedback,$feedbackDatetime,$provider_nic,$nic);
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
}

