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


        $confirmation = 0;
        $stmt = $db->connection->prepare("SELECT * FROM doctor_time_slot INNER JOIN appointment ON doctor_time_slot.appointment_id = appointment.appointment_id  INNER JOIN service_consumer ON service_consumer.consumer_nic = appointment.consumer_nic WHERE appointment.provider_nic = ? && appointment.confirmation = ?");
        $stmt->bind_param("si", $nic,$confirmation);
        $stmt->execute();
        $result = $stmt->get_result();
        $appointment_details = $result->fetch_all(MYSQLI_ASSOC);


        return self::render(view: 'doctor-dashboard-appointments', layout: "doctor-dashboard-layout", params: [
            "appointments" => $appointments,"appointments_details"=>$appointment_details
        ], layoutParams: [
            "title" => "Appointments",
            "active_link" => "appointments",
            "doctor" => $doctor
        ]);
    }


    public static function DoctorAppointmentsProcess():array|bool|string{
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];

        if (!$nic || $providerType != "doctor") {
            header("location: /provider-login");
            return "";
        }

        $db = new database();
        if(empty($_GET)){
            $empty = $_GET;
        }else{
            $appointment_id = $_GET['appointment_id'];
            $id = $_GET['id'];

            if($id==2){
                $stmt = $db->connection->prepare("UPDATE appointment SET confirmation = 1 WHERE appointment_id = ?");
                $stmt->bind_param("i",$appointment_id );
                $stmt->execute();
                $result = $stmt->get_result();
            }else{
                $stmt = $db->connection->prepare("UPDATE appointment SET confirmation = 2 WHERE appointment_id = ?");
                $stmt->bind_param("i",$appointment_id );
                $stmt->execute();
                $result = $stmt->get_result();
            }
        }
        header("location: /doctor-dashboard/appointments");

        return self::render(view: 'doctor-dashboard-appointments', layout: "doctor-dashboard-layout", params: [
        ], layoutParams: [
            "title" => "Appointments",
            "active_link" => "appointments",
        ]);

    }

}
