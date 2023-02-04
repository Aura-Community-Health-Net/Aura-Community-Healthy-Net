<?php

namespace app\controllers;

use app\core\Database;
use app\core\Controller;

class AnalyticsController extends Controller
{
    public static function getCareRiderAnalyticsPage()
    {
        return self::render(view: "care-rider-analytics");
    }

    public static function getDoctorAnalyticsPage():array|bool|string{

        return self::render(view:'doctor-analytics', layout: "doctor-dashboard-layout", params: [],layoutParams: [
            "title" => "Analytics",
            "active_link" => ""
        ]);

    }

    public function getProductSellerAnalyticsPage(): bool|array|string
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

        return self::render(view: 'product-seller-dashboard-analytics', layout: "product-seller-dashboard-layout", layoutParams: [
            "product_seller" => $product_seller,
            "active_link" => "analytics",
            "title" => "Analytics"
        ]);
    }

}