<?php

namespace app\controllers;

use app\core\Controller;
use app\core\database;

class DoctorAppointmentsController extends Controller
{

    public static function getDoctorAppointmentsPage():array|bool|string{
        $nic = $_SESSION["nic"];
        //print_r($nic);
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

    public static function DoctorAppointments():array|bool|string{
        $provider_nic = $_SESSION["nic"];
        //print_r($nic);
        $providerType = $_SESSION["user_type"];
        $confirmation = 0;

        if (!$provider_nic || $providerType != "doctor") {
            header("location: /provider-login");
            return "";
        }

        $db = new database();
        $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
        $stmt->bind_param("s", $provider_nic);
        $stmt->execute();
        $result = $stmt->get_result();
        $doctor = $result->fetch_assoc();


        $stmt = $db->connection->prepare("SELECT * FROM doctor_time_slot INNER JOIN appointment ON doctor_time_slot.appointment_id = appointment.appointment_id  INNER JOIN service_consumer ON service_consumer.consumer_nic = appointment.consumer_nic WHERE appointment.provider_nic = ? && confirmation = ?");
        $stmt->bind_param("si", $provider_nic,$confirmation);
        $stmt->execute();
        $result = $stmt->get_result();
        $appointment_details = $result->fetch_all(MYSQLI_ASSOC);

        $confirm = 1;
        $appointment_id = $_GET['appointment_id'];
        $stmt = $db->connection->prepare("UPDATE appointment SET confirmation = ?
                               WHERE appointment_id = $appointment_id");
        $stmt->bind_param("i",$confirm );
        $stmt->execute();
        $result = $stmt->get_result();
        //print_r($appointment_details);die();
        /*var_dump($timeslots);
        exit();*/
        return self::render(view: 'doctor-dashboard-appointments', layout: "doctor-dashboard-layout", params: ["appointments_details"=>$appointment_details
        ], layoutParams: [
            "title" => "Appointments",
            //"active_link" => "appointments",
            "appointments_details" => $appointment_details,
            "doctor" => $doctor
        ]);
    }

}
