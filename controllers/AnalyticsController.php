<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Database;

class AnalyticsController extends Controller
{
    public static function getCareRiderAnalyticsPage()
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

        return self::render(view: "care-rider-dashboard-analytics",layout: "care-rider-dashboard-layout", layoutParams: [
            "care_rider" => $careRider,
            "active_link" => "analytics",
            "title" => "Analytics"]);
    }

    public static function getDoctorAnalyticsPage():array|bool|string{

        return self::render(view:'doctor-analytics', layout: "doctor-dashboard-layout", params: [],layoutParams: [
            "title" => "Analytics",
            "active_link" => ""
        ]);

    }

}