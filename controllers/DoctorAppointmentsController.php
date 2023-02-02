<?php

namespace app\controllers;

use app\core\Controller;
use app\utilities\database;

class DoctorAppointmentsController extends Controller
{
    public static function getDoctorAppointmentsPage():array|bool|string{

        return self::render(view:'doctor-appointments', layout: "doctor-dashboard-layout", params: [],layoutParams: [
            "title" => "New Appointments",
            "active_link" => ""
        ]);

    }

}
