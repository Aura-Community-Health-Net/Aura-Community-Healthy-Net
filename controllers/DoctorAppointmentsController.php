<?php

namespace app\controllers;

use app\core\Controller;
use app\core\database;

class DoctorAppointmentsController extends Controller
{

    public static function getDoctorAppointmentsPage():array|bool|string{
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
        $appointments = $result->fetch_all(MYSQLI_ASSOC);

        /*var_dump($timeslots);
        exit();*/
        return self::render(view: 'doctor-dashboard-appointments', layout: "doctor-dashboard-layout", params: [
            "appointments" => $appointments
        ], layoutParams: [
            "title" => "Appointments",
            "active_link" => "appointments",
            "doctor" => $doctor
        ]);
    }

}
