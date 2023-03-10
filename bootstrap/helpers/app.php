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
        if(is_array($data)){
            echo '<pre>';
            print_r($data);
        }else{
            echo $data;
        }
        die;
    }
}