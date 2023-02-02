<?php

namespace app\controllers;

use app\core\Controller;

class ProfileController extends Controller
{
    public static function getCareRiderProfilePage(): bool|array|string
    {
        return self::render(view:"care-rider-dashboard-profile");
    }

    public static function getDoctorProfilePage():array|bool|string{

        return self::render(view:'doctor-dashboard-profile', layout: "doctor-dashboard-layout", params: [],layoutParams: [
            "title" => "Profile",
            "active_link" => ""
        ]);

    }

}