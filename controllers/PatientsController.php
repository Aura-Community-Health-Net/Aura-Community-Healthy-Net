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


    public static function DoctorPatients(): array|bool|string
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


        $stmt = $db->connection->prepare("SELECT MAX(doctor_time_slot.date),service_consumer.profile_picture,service_consumer.name,doctor_time_slot.date,service_consumer.mobile_number FROM doctor_time_slot INNER JOIN appointment ON appointment.appointment_id = doctor_time_slot.appointment_id INNER JOIN service_consumer ON service_consumer.consumer_nic = appointment.consumer_nic WHERE appointment.provider_nic = ? && appointment.done = 1 GROUP BY appointment.consumer_nic ");
        $stmt->bind_param("s", $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        $patient_details = $result->fetch_all(MYSQLI_ASSOC);

        //print_r($patient_details);die();

        return self::render(view: 'doctor-dashboard-patients', layout: "doctor-dashboard-layout", params: [
            "doctor" => $doctor,"patient_details"=>$patient_details
        ], layoutParams: [
            "title" => "Patients",
            "active_link" => "doctor",
            "doctor" => $doctor,
            "patient_details"=>$patient_details
        ]);
    }
}