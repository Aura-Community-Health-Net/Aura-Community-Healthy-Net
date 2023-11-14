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
        return self::render(view: 'site-home',params:  $params, layoutParams: ["title" => "Aura | Home"]);
    }

    public static function contactUs(): array|bool|string
    {
        $params = [
            'name' => "Contact Us"
        ];
        return self::render(view: 'site-contact', params: $params, layoutParams: ["title" => "Contact Us"]);
    }

    public static function userAgreement(): bool|array|string
    {
        $params = [
            'name'=>"Terms, Conditions, User Agreements"
        ];
        return self::render(view: 'user-agreement', params: $params, layoutParams: ["title"=>"Terms, Conditions and User Agreements"]);
    }

    public static function aboutUs(){
        $params = [
            'name'=>"About Us"
        ];
        return self::render(view: 'about-us', params: $params, layoutParams: ["title"=>"About Us"]);
    }
}