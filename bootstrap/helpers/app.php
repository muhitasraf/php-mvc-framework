<?php

use Core\Application;

$app = new Application();

if (!function_exists('view')) {
    function view($view, $params = []): bool
    {
        global $app;
        return $app->render($view, $params);
    }
}

if (!function_exists('dd')) {
    function dd($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        exit();
    }
}

if(!function_exists('redirect')){
    function redirect($redirect_to){
        return header("location:$redirect_to");
    }
}