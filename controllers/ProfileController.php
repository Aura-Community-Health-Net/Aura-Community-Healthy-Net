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
        return self::render(view: 'doctor-dashboard-profile', layout: "doctor-dashboard-layout", params: [], layoutParams: [
            "active_link" => "Profile",
            "title" => "Profile",
            "doctor" => $doctor
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

    public function getConsumerServicesDoctorProfilePage(): bool|array|string
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
}
