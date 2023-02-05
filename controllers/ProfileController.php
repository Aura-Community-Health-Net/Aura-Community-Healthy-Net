<?php

namespace app\controllers;

use  app\core\Database;
use app\core\Controller;


class ProfileController extends Controller
{
    public static function getCareRiderProfilePage(): bool|array|string
    {
        return self::render(view: "care-rider-dashboard-profile");
    }

    public static function getDoctorProfilePage(): array|bool|string
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
            $doctor = $result->fetch_assoc();

            return self::render(view: 'doctor-dashboard-profile', layout: "doctor-dashboard-layout", params: [], layoutParams: [
                "doctor" => $doctor,
                "title" => "Profile",
                "active_link" => ""
            ]);
        }

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
        if(!$nic || $providerType !== "product-seller"){
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
        $nic =$_SESSION["nic"];
        $userType = $_SESSION["user_type"];
        if(!$nic || $userType !== "consumer"){
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
            "title" => "Doctor"]);
    }

    public function getConsumerServicesDoctorProfilePage(): bool|array|string
    {
        $nic =$_SESSION["nic"];
        $userType = $_SESSION["user_type"];
        if(!$nic || $userType !== "consumer"){
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
            "title" => "Doctor"]);
    }

    public function getConsumerServicesDoctorProfilePaymentPage(): bool|array|string
    {
        $nic =$_SESSION["nic"];
        $userType = $_SESSION["user_type"];
        if(!$nic || $userType !== "consumer"){
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
            "title" => "Doctor"]);
    }
}