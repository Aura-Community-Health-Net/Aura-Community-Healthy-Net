<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Database;

class DashboardController extends Controller
{
    public static function getProductSellerDashboardPage(): array |bool|string
    {
        $nic = $_SESSION["nic"];
        if (!$nic) {
            header("location: /provider-login");
            return "";
        } else {
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $product_seller = $result->fetch_assoc();
            return self::render(
            view: 'product-seller-dashboard', layout: "product-seller-dashboard-layout", params: [
                    "product_seller" => $product_seller
                ],
            layoutParams: [
                    "title" => "Dashboard",
                    "product_seller" => $product_seller,
                    "active_link" => "dashboard"
                ]
            );
        }


    }
    public static function getPharmacyDashboard(): bool|array|string
    {

        $nic = $_SESSION["nic"];
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

            return self::render(view: 'pharmacy-dashboard', layout: "pharmacy-dashboard-layout", layoutParams: [
                "pharmacy" => $pharmacy,
                "title" => "Dashboard",
                "active_link" => "dashboard"
            ]);
        }
    }

    public static function getCareRiderDashboard(): bool|array|string
    {
        $nic = $_SESSION["nic"];

        if (!$nic) {
            header("location: /provider-login");
            return "";
        } else {
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $care_rider = $result->fetch_assoc();

            return self::render(view: 'care-rider-dashboard', layout: "care-rider-dashboard-layout", layoutParams: [
                "care_rider" => $care_rider,
                "title" => "Dashboard",
                "active_link" => "dashboard"
            ]);
        }
    }

    public static function getDoctorDashboardPage(): array |bool|string
    {
        $nic = $_SESSION["nic"];
        $provideType = $_SESSION["user_type"];
        if (!$nic || $provideType !== "doctor") {
            header("location: /provider-login");
            return "";
        } else {
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $doctor = $result->fetch_assoc();

            return self::render(view: 'doctor-dashboard', layout: "doctor-dashboard-layout", layoutParams: [
                "doctor" => $doctor,
                "title" => "Dashboard",
                "active_link" => "dashboard"
            ]);
        }
    }

    public static function getConsumerDashboardPage(): array |bool|string{
        $nic = $_SESSION["nic"];
        if (!$nic){
            header("location: /login");
            return "";
        } else{
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $consumer = $result->fetch_assoc();

            return self::render(view: 'consumer-dashboard', layout: 'consumer-dashboard-layout', layoutParams: [
                "consumer" => $consumer,
                "title" => "Dashboard",
                "active_link" => "dashboard"
            ]);
        }
    }
}