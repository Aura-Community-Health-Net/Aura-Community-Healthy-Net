<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Database;

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

    public static function getPharmacyAnalyticsPage():array|bool|string
    {
        $nic = $_SESSION["nic"];

        if (!$nic) {
            header("/pharmacy-login");
        } else {

            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $pharmacy = $result->fetch_assoc();


            return self::render(view: 'pharmacy-dashboard-analytics', layout: "pharmacy-dashboard-layout", params: [], layoutParams: [
                "pharmacy" => $pharmacy,
                "title" => "Analytics",
                "active_link" => ""
            ]);
        }
    }

}

