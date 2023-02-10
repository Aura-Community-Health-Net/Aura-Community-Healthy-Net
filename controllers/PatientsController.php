<?php

namespace app\controllers;

use app\core\Controller;
use app\core\database;

class PatientsController extends Controller
{
    public static function getDoctorPatientsPage(): array|bool|string
    {

        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];

        if (!$nic || $providerType != "doctor") {
            header("location: /provider-login");
            return "";
        }

        $db = new database();
        $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
        $stmt->bind_param("s", $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        $doctor = $result->fetch_assoc();
        $stmt = $db->connection->prepare("SELECT * FROM doctor_time_slot WHERE provider_nic = ?");
        $stmt->bind_param("s", $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        $timeslots = $result->fetch_all(MYSQLI_ASSOC);

        /*var_dump($timeslots);
        exit();*/
        return self::render(view: 'doctor-dashboard-patients', layout: "doctor-dashboard-layout", params: [
            "doctor" => $doctor
        ], layoutParams: [
            "title" => "Patients",
            "active_link" => "doctor",
            "doctor" => $doctor
        ]);
    }
}