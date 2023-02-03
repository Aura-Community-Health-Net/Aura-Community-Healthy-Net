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

        return self::render(view: 'doctor-dashboard-appointments', layout: "doctor-dashboard-layout", params: [
        ], layoutParams: [
            "title" => "Appointments",
            "active_link" => "appointments",
        ]);

    }

}
