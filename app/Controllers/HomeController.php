<?php

namespace App\Controllers;

use Core\Request;

class HomeController extends Controller{

    public function test(Request $request){

        $t2='test v 2';
        return view('home.index',compact('t2'));
    }

    public function test2(){
        dd(str_replace('public','',dirname($_SERVER['SCRIPT_NAME'])));
        // dd(dirname(dirname(__FILE__)));
        // echo json_encode($_GET);
        return redirect('home.index');
    }

    public function test3(){
        echo 'its work 3';
    }

    public function work(){
        print_r($_GET);
    }
}