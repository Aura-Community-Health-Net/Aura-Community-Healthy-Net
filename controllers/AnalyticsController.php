<?php

namespace app\controllers;

use app\core\Controller;

class AnalyticsController extends Controller
{
    public static function getCareRiderAnalyticsPage()
    {
        return self::render(view: "care-rider-analytics");
    }

    public static function getDoctorAnalyticsPage():array|bool|string{

        return self::render(view:'doctor-analytics', layout: "doctor-dashboard-layout", params: [],layoutParams: [
            "title" => "Analytics",
            "active_link" => ""
        ]);

    }

}