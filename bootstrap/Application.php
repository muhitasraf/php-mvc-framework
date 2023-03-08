<?php
namespace Core;
class Application{
    use Router, Request;

    public function run(){

        $callable = $this->match($this->getMethod(), $this->getPath());
        
        // echo '<pre>';
        // print_r(self::getPath());
        // echo '<pre>';
        // var_dump(substr(self::getPath(), -1));
        // echo '<pre>';
        // print_r(self::$map[$this->getMethod()]);
        // echo substr(self::getPath(), strpos(self::getPath(), '/', 1),strlen(self::getPath()));
        // echo '<br>'.substr(self::getPath(), -1);
        // exit;

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
        foreach (self::$map[$method] as $uri=>$call){
            if (substr($url, -1) === '/' && $uri != '/'){
                //remove the slash
                $url = substr($url, 0, -1);
            }
            //if our $uri does not contain a pre-slash, we add it
            if (substr($url, strpos($url, '/', 1),strlen($url)) === $uri){
                return $call;
            }
        }
        return false;
    }
}