<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Database;

class FeedbacksController extends Controller
{
    public static function getCareRiderFeedbackPage(): bool|array|string
    {
        return self::render(view: "care-rider-feedback");
    }

    public static function getDoctorFeedbackPage(): array|bool|string
    {

        return self::render(view: 'doctor-feedback', layout: "doctor-dashboard-layout", params: [], layoutParams: [
            "title" => "Feedback",
            "active_link" => ""
        ]);

    }

    public static function getProductSellerFeedbackPage(){
        $nic =$_SESSION["nic"];
        $providerType = $_SESSION["user-type"];
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

        return self::render(view: 'product-seller-dashboard-feedback', layout: "product-seller-dashboard-layout", layoutParams: [
            "product_seller" => $product_seller,
            "active_link" => "feedback",
            "title" => "Feedback"
        ]);
    }
}