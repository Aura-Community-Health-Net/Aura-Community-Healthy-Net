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

    public static function getPharmacyFeedbackPage(): bool|array|string

    {
        $nic = $_SESSION["nic"];

        if (!$nic)
        {
            header("/pharmacy-login");
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


}