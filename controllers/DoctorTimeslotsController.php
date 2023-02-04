<?php

namespace app\controllers;

use app\core\Controller;
use app\core\database;

class DoctorTimeslotsController extends Controller
{
    public static function getDoctorTimeslotsPage(): array|bool|string
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
        $sql = "(SELECT * FROM doctor_time_slot ORDER BY slot_number DESC LIMIT 5) ORDER BY slot_number ASC";
        $timeslots = $db->connection->query(query: $sql);


        return self::render(view: 'doctor-dashboard-timeslots', layout: "doctor-dashboard-layout", params: [
            "timeslots" => $timeslots
        ], layoutParams: [
            "title" => "Timeslots",
            "active_link" => "timeslots",
            "doctor" => $doctor
        ]);
    }

    public static function addDoctorTimeslots(): array|bool|string
    {

        $db = new database();

        $errors = [];
        if (empty($errors)) {

            $stmt = $db->connection->prepare("INSERT INTO doctor_time_slot (
                              date,
                              from_time,
                              to_time
                              ) VALUES ( ?, ?, ? )");

            $stmt->bind_param("sss", $_POST["date"], $_POST["from-time"], $_POST["to-time"]);
            $stmt->execute();
            $result = $stmt->get_result();
            header("location: /doctor-dashboard/timeslots");
            return "";

        } else {
            return self::render(view: 'doctor-dashboard-timeslots', layout: "doctor-dashboard-layout", layoutParams: ['errors' => $errors]);
        }
    }
}