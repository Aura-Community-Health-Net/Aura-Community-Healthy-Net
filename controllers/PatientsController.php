<?php

namespace app\controllers;

use app\core\Controller;
use app\utilities\database;

class PatientsController extends Controller
{
    public static function getDoctorPatientsPage(): array|bool|string
    {

        return self::render(view: 'doctor-patients', layout: "doctor-dashboard-layout", params: [], layoutParams: [
            "title" => "Past Patients",
            "active_link" => ""
        ]);

    }
}