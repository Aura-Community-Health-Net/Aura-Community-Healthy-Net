<?php

namespace app\controllers;

use app\core\Controller;

class CareRiderNewRequestsController extends Controller
{
    public static function getNewRequestsPage()
    {
        return self::render(view: "care-rider-dashboard-new-requested");
    }

}