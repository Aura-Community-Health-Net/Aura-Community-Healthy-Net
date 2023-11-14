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

        //print_r($_GET);
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


        $done = 0;
        $stmt = $db->connection->prepare("SELECT * FROM doctor_time_slot INNER JOIN appointment ON doctor_time_slot.appointment_id = appointment.appointment_id  INNER JOIN service_consumer ON service_consumer.consumer_nic = appointment.consumer_nic WHERE appointment.provider_nic = ? && appointment.done = ? && appointment.status = 'paid'");
        $stmt->bind_param("si", $nic,$done);
        $stmt->execute();
        $result = $stmt->get_result();
        $appointment_details = $result->fetch_all(MYSQLI_ASSOC);
        //print_r($appointment_details);


        return self::render(view: 'doctor-dashboard-appointments', layout: "doctor-dashboard-layout", params: [
            "appointments" => $appointments,"appointments_details"=>$appointment_details,"doctor" => $doctor
        ], layoutParams: [
            "title" => "Appointments",
            "active_link" => "appointments",
            "doctor" => $doctor
        ]);
    }


    public static function DoctorAppointmentsProcess():array|bool|string{
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];

//        print_r($_GET);
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

            if($id==1){
                $stmt = $db->connection->prepare("UPDATE appointment SET done = 1 WHERE appointment_id = ?");
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

//    public static function DoctorAppointmentsLocationProcess():array|bool|string{
//        $nic = $_SESSION["nic"];
//        $providerType = $_SESSION["user_type"];
//
//        $appointment_id = $_GET['appointment_id'];
//        if (!$nic || $providerType != "doctor") {
//            header("location: /provider-login");
//            return "";
//        }
//
//        print_r($_GET);
//        $db = new database();
//        $stmt = $db->connection->prepare("SELECT location FROM appointment WHERE appointment_id = ?");
//        $stmt->bind_param("i", $appointment_id);
//        $stmt->execute();
//        $result = $stmt->get_result();
//        $location = $result->fetch_assoc();
//
//        //print_r($location);
//        header("location: /doctor-dashboard/appointments");
//
//        return self::render(view: 'doctor-dashboard-appointments', layout: "doctor-dashboard-layout", params: [
//            "location"=>$location
//        ], layoutParams: [
//            "title" => "Appointments",
//            "active_link" => "appointments",
//        ]);
//
//    }

}
