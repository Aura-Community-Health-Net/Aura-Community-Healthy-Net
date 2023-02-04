<?php

namespace app\controllers;

use app\core\Controller;

class FeedbacksController extends Controller
{
    public static function getCareRiderFeedbackPage(): bool|array|string
    {
        return self::render(view: "care-rider-feedback");
    }

    public static function getDoctorFeedbackPage(): array|bool|string
    {

        return self::render(view: 'doctor-dashboard-feedback', layout: "doctor-dashboard-layout", params: [], layoutParams: [
            "title" => "Feedback",
            "active_link" => ""
        ]);

    }
}