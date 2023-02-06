<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Database;

class FeedbacksController extends Controller
{
    public static function getCareRiderFeedbackPage(): bool|array|string
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

        return self::render(view: "care-rider-dashboard-feedback", layout: "care-rider-dashboard-layout", params: [], layoutParams: [
            "care_rider" => $careRider,
            "title" => "Feedback",
            "active_link" => "feedbacks"
        ]);
    }

    public static function getDoctorFeedbackPage(): array|bool|string
    {


        return self::render(view: 'doctor-dashboard-feedback', layout: "doctor-dashboard-layout", params: [], layoutParams: [
            "title" => "Feedback",
            "active_link" => ""
        ]);

    }

    public static function getPharmacyFeedbackPage(): bool|array|string

    {
        $nic = $_SESSION["nic"];
	$providerType = $_SESSION["user_type"];

        if (!$nic || $providerType !== "pharmacy")
        {
            header("location: /provider-login");
	    return "";
        }
        else {

            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $pharmacy = $result->fetch_assoc();

            return self::render(view: 'pharmacy-dashboard-feedback', layout: "pharmacy-dashboard-layout", params: [], layoutParams: [
                "pharmacy" => $pharmacy,
                "title" => "Feedback",
                "active_link" => ""
            ]);
 }
}

    public static function getProductSellerFeedbackPage(): bool|array|string
    {
        $nic =$_SESSION["nic"];
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

        return self::render(view: 'product-seller-dashboard-feedback', layout: "product-seller-dashboard-layout", layoutParams: [
            "product_seller" => $product_seller,
            "active_link" => "feedback",
            "title" => "Feedback"
        ]);
    }




    public  static function getConsumerFeedbackPage()
    {
        $nic =$_SESSION["nic"];
        $userType = $_SESSION["user_type"];
        if(!$nic || $userType !== "consumer"){
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

        return self::render(view: 'consumer-dashboard-feedback', layout: "consumer-dashboard-layout", layoutParams: [
            "consumer" => $consumer,
            "active_link" => "feedback",
            "title" => "Feedback"]);





    }






}