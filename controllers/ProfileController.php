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

        return self::render(view: 'doctor-dashboard-profile', layout: "doctor-dashboard-layout", params: [], layoutParams: [
            "title" => "Profile",
            "active_link" => ""
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

}