<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Database;

class ProfileController extends Controller
{

    public static function getCareRiderProfilePage(): array|bool|string{
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


        return self::render(view:'care-rider-dashboard-profile', layout: "care-rider-dashboard-layout", params: [],layoutParams: [
            "active_link" => "Profile",
            "title" => "Profile",
            "care_rider" => $careRider

        ]);

    }

}