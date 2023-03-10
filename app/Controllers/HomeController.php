<?php

namespace App\Controllers;

class HomeController extends Controller{
    public function test(){
        // if(!empty($_GET))
        //     dd($_GET);
        if(!empty($_POST)){
            dd($_POST);
        }
        $t1=$_POST['name']??'';
        $t2='test v 2';
        return view('home.index',compact('t1','t2'));
    }
    public function test2(){
        dd($_GET);
        echo json_encode('its work 2');
    }
    public function test3(){
        echo 'its work 3';
    }

    public function work(){
        print_r($_GET);
    }
}