<?php
namespace Core;

class Application{
    use Router, HttpRequest, View;

    public function run(){
        
        $http_method = self::getMethod();
        $url_path = self::getPath();
        // $route = substr($url_path, strpos($url_path, '/', 1), strlen($url_path));
        // $last_slash_pos = strripos($route, '/');
        // $value_after_last_slash = substr($route, $last_slash_pos + 1, strlen($route));
        // dd($value_after_last_slash);
        $callable = $this->match($http_method, $url_path);

        if(!$callable){
            throw new \Exception('404 Not Found', 404);
        }

        $class = "App\\Controllers\\".$callable['class'];
        if(!class_exists($class)){
            throw new \Exception('Class Does Not Found.', 500);
        }

        $method = $callable['method'];
        if(!is_callable($class, $method)){
            throw new \Exception("Method '$method' is not found in class '$callable[class]'", 500);
        }

        $class = new $class;
        $class->$method();
        return;        
    }

    private function match($method, $url)
    {
        $route = substr($url, strpos($url, '/', 1), strlen($url));
        $last_slash_pos = strripos($route, '/');
        $value_after_last_slash = substr($route, $last_slash_pos +1, strlen($route));

        $value_before_qt = substr(substr($route, $last_slash_pos, strlen($route)), 0, strpos(substr($route, $last_slash_pos, strlen($route)), '?', 1));
        // echo '<pre>';
        // print_r(self::$map[$method]);
        // echo '<br>'.$value_before_qt.'<br>';
        // dd(substr($route, 0, $last_slash_pos).'{id}');
        foreach (self::$map[$method] as $uri=>$call){
            if (substr($url, -1) === '/' && $uri != '/'){
                $url = substr($url, 0, -1);
            }
            if ($value_before_qt === $uri && strpos($url, '?', 1)!=false){
                return $call;
            }
            // dd(is_numeric($value_after_last_slash));
            // echo '<br>'.substr($route, 0, $last_slash_pos).'{id}' .'=='. $uri;
            if(is_numeric($value_after_last_slash)==1 && substr($route, 0, $last_slash_pos).'/{id}' === $uri){
                
                return $call;
            }
            if (substr($url, strpos($url, '/', 1),strlen($url)) === $uri){
                return $call;
            }
        }
        return false;
    }
}