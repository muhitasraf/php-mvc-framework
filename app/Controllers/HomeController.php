<?php

namespace App\Controllers;

use App\Models\Home;

class HomeController extends Controller{
    public $home;
    public function __construct(){
        // $this->home = new Home();
    }
    public function test(){
        // $q = $this->home->table('products')->select('product_title','product_price')->fetchAll();
        $q = Home::query("SELECT * FROM products")->fetchAll();
        dd($q);
        $t2='test v 2';
        return view('home.index',compact('t2'));
    }

    public function test2(){
        $with = [
            'errors' => $_POST ?? ''
        ];
        return redirect('',['with'=>$with]);
    }

    public function test3(){
        echo 'its work 3';
    }

    public function work(){
        print_r($_GET);
    }
}