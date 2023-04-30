<?php

namespace app\controllers;

use app\core\Database;
use app\core\Controller;


class AnalyticsController extends Controller
{
    public static function getCareRiderAnalyticsPage(): array|bool|string
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

        return self::render(view: "care-rider-dashboard-analytics", layout: "care-rider-dashboard-layout", layoutParams: [
            "care_rider" => $careRider,
            "active_link" => "analytics",
            "title" => "Analytics"]);
    }

    public static function getDoctorAnalyticsPage(): array|bool|string
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

        return self::render(view: 'doctor-dashboard-analytics', layout: "doctor-dashboard-layout", params: [
        ], layoutParams: [
            "title" => "Analytics",
            "active_link" => "analytics",
            "doctor" => $doctor
        ]);

    }

    public function getProductSellerAnalyticsPage(): bool|array|string
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

        return self::render(view: 'product-seller-dashboard-analytics', layout: "product-seller-dashboard-layout", layoutParams: [
            "product_seller" => $product_seller,
            "active_link" => "analytics",
            "title" => "Analytics"
        ]);
    }


    public static function getPharmacyAnalyticsPage(): array|bool|string
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];

        if (!$nic || $providerType !== "pharmacy") {
            header("/provider-login");
            return "";
        } else {

            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $pharmacy = $result->fetch_assoc();
        }


        return self::render(view: 'pharmacy-dashboard-analytics', layout: "pharmacy-dashboard-layout", params: [], layoutParams: [
            "pharmacy" => $pharmacy,
            "title" => "Analytics",
            "active_link" => ""
        ]);
    }

    public static function getConsumerAnalyticsPage()
    {
        $nic = $_SESSION["nic"];
        $userType = $_SESSION["user_type"];
        if (!$nic || $userType !== "consumer") {
            header("location: /provider-login");
            return "";
        } else {
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $consumer = $result->fetch_assoc();
        }

        return self::render(view: 'consumer-dashboard-analytics', layout: "consumer-dashboard-layout", layoutParams: [
            "consumer" => $consumer,
            "active_link" => "analytics",
            "title" => "Analytics"]);
    }

    public static function getProductSellerAnalyticsRevenueChart()
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$nic || $providerType !== "product-seller") {
            header("location: /provider-login");
            return "";
        } else {
            $db = new Database();
            $chart_time = $_GET["period"] ?? "all_time";

            $stmt = "";
            switch ($chart_time) {
                case "this_week";
                    $stmt = $db->connection->prepare("SELECT DATE(date_time) as date, SUM(amount) as revenue
                                                    FROM payment_record 
                                                    WHERE provider_nic = ? 
                                                    AND YEAR(date_time) = YEAR(NOW()) 
                                                    AND WEEK(date_time, 1) = WEEK(NOW(), 1)
                                                    GROUP BY DATE(date_time)");
                    break;

                case "this_month";
                    $stmt = $db->connection->prepare("SELECT DATE(date_time) as date, SUM(amount) as revenue 
                                                    FROM payment_record 
                                                    WHERE provider_nic = ? 
                                                    AND YEAR(date_time) = YEAR(NOW()) 
                                                    AND MONTH(date_time) = MONTH(NOW())
                                                    GROUP BY DATE(date_time)");
                    break;

                case "past_six_months";
                    $stmt = $db->connection->prepare("SELECT DATE(date_time) as date, SUM(amount) as revenue
                                                    FROM payment_record 
                                                    WHERE provider_nic = ? 
                                                    AND date_time BETWEEN DATE_SUB(NOW(), INTERVAL 6 MONTH) AND NOW()
                                                    GROUP BY DATE(date_time)");
                    break;

                case "this_year";
                $stmt = $db->connection->prepare("SELECT DATE(date_time) as date, SUM(amount) as revenue
                                                    FROM payment_record 
                                                    WHERE provider_nic = ? 
                                                    AND YEAR(date_time) = YEAR(NOW()) 
                                                    GROUP BY DATE(date_time)");
                    break;

                case "all_time";
                $stmt = $db->connection->prepare("SELECT DATE(date_time) as date, SUM(amount) as revenue
                                                    FROM payment_record 
                                                    WHERE provider_nic = ? 
                                                    GROUP BY DATE(date_time)");
                    break;
            }
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $records = $result->fetch_all(MYSQLI_ASSOC);
            header("Content-Type: application/json");
            return json_encode($records);
        }


    }


}
