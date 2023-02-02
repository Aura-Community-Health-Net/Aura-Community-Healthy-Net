<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public static function home(): array|bool|string
    {
        $params = [
            'name' => "Aura Community Health Net"
        ];
        return self::render(view: 'site-home',params:  $params);
    }

    public static function contact(): array|bool|string
    {
        return self::render(view: 'contact');
    }
}