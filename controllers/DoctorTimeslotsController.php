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

        $stmt = $db->connection->prepare("SELECT * FROM doctor_time_slot WHERE provider_nic = ?");
        $stmt->bind_param("s", $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        $timeslots = $result->fetch_all(MYSQLI_ASSOC);

        /*var_dump($timeslots);
        exit();*/
        return self::render(view: 'doctor-dashboard-timeslots', layout: "doctor-dashboard-layout", params: [
            "timeslots" => $timeslots, "doctor" => $doctor
        ], layoutParams: [
            "title" => "Timeslots",
            "active_link" => "timeslots",
            "doctor" => $doctor
        ]);
    }

    public static function addDoctorTimeslots(): array|bool|string
    {
        $nic = $_SESSION['nic'];
        $providerType = $_SESSION['user_type'];
        if (!$nic || $providerType !== "doctor") {
            header("location: /provider-login");
            return "";
        }

        $db = new Database();
        $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
        $stmt->bind_param("s", $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        $doctor = $result->fetch_assoc();


        if (!$doctor["is_verified"]) {
            return "
        <style>
        .verification-error{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            font-size: 4rem;
            color: rgba(0, 0, 0, 0.3);
        }
       </style>
        <div class='verification-error'>You're not verified, Please check later</div>";
        }

        $errors = [];
        if (empty($errors)) {

            $stmt = $db->connection->prepare("INSERT INTO doctor_time_slot (
                              date,
                              from_time,
                              to_time,
                              provider_nic
                              
                              ) VALUES ( ?, ?, ?,? )");

            $stmt->bind_param("ssss", $_POST["date"], $_POST["fromTime"], $_POST["toTime"], $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            header("location: /doctor-dashboard/timeslots");
            return "";

        } else {
            return self::render(view: 'doctor-dashboard-timeslots', layout: "doctor-dashboard-layout", layoutParams: ['errors' => $errors]);
        }
    }

    public static function deleteTimeslot(): array|bool|string
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$nic || $providerType !== "doctor") {
            header("location: /provider-login");
            return "";
        }
        $slot_number = $_GET["slotNo"];

        $db = new Database();
        $stmt = $db->connection->prepare("DELETE FROM doctor_time_slot WHERE slot_number = ? AND provider_nic = ?");
        $stmt->bind_param("ds", $slot_number, $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        header("location: /doctor-dashboard/timeslots");
        return "";
    }

    public static function editTimeslot(): array|bool|string
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$nic || $providerType !== "doctor") {
            header("location: /provider-login");
            return "";
        }
        $slot_number = $_GET["slotNo"];
        $editDate = $_POST["edit-date"];
        $editFromTime = $_POST["edit-fromTime"];
        $editTOTime = $_POST["edit-toTime"];

        $db = new Database();
        $stmt = $db->connection->prepare("UPDATE doctor_time_slot SET date = ?,
                              from_time = ?,
                              to_time = ?,
                              provider_nic = ? WHERE slot_number = $slot_number");
        $stmt->bind_param("ssss", $editDate, $editFromTime, $editTOTime,$nic);
            $stmt->execute();
            $result = $stmt->get_result();


        header("location: /doctor-dashboard/timeslots");
        return "";
    }
}
