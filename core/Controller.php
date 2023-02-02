<?php

namespace app\core;

class Controller
{
    public static function render($view, $layout = "main-layout", $params = [], $layoutParams = []): array|bool|string
    {
        return Application::$app->router->renderView(view:$view, layout: $layout, params: $params, layoutParams: $layoutParams);
    }
}