<?php

namespace app\controllers;

use app\core\Controller;
use app\core\database;

class PatientsController extends Controller
{
    public static function getDoctorPatientsPage(): array|bool|string
    {
        $nic = $_SESSION["nic"];
        if (!$nic) {
            header("location: /provider-login");
            return "";
        }else{
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $product_seller = $result->fetch_assoc();
        }

        return self::render(view: 'doctor-dashboard-patients', layout: "doctor-dashboard-layout", params: [
            "product_seller" => $product_seller
        ], layoutParams: [
            "title" => "Past Patients",
            "product_seller" => $product_seller,
            "active_link" => "patients"
        ]);

    }
}