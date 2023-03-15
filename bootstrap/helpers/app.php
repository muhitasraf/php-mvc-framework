<?php

use Core\Application;

$app = new Application();

if (!function_exists('route')) {
    function route($url=null) {
        return URL.$url;
    }
}

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

if (!function_exists('redirect')) {
    function redirect($url=null,$with=[]) {
        if ($with){
            with($with['with']);
        }
        return header('Location:'.URL.$url);
    }
}

if (!function_exists('with')) {
    function with($with=null)
    {
        $errors = $with['errors'] ?? null;
        $inputs = $with['inputs'] ?? null;
        session('errors', $errors);
        session('inputs', $inputs);
    }
}

if (!function_exists('session')) {
    function session($key=null,$val=null)
    {
        if(is_array($key)){
             foreach ($key as $item=>$val){
                 $_SESSION[$item] = $val;
             }
        }else if(isset($key) && isset($val)){
            return $_SESSION[$key] = $val;
        }elseif(isset($key)){
            return $_SESSION[$key] ?? '';
        }
        return;
    }
}

if (!function_exists('_csrf')) {
    function _csrf()
    {
        $csrf_token = bin2hex(random_bytes(32));
        session('_csrf',$csrf_token);
        return '<input type="hidden" id="_csrf" name="_csrf" value='.$csrf_token.'>';
    }
}

if (!function_exists('auth')) {
    function auth()
    {
        return session('logged_in');
    }
}