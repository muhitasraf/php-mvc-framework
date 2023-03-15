<?php

namespace App\Controllers;

use App\Models\Home;

class HomeController extends Controller{
    public $home;
    public function __construct(){
        $this->home = new Home();
    }
    public function test(){

        //Fetch Data Using Query Builder
        $data = Home::table('products')->select('product_title','product_price')->fetchAll();

        //Fetch Data With Raw Query In Controller
        $data1 = Home::query("SELECT * FROM products")->fetchAll();

        //Fetch Data Using Raw Query From Model
        $data2 = $this->home->test()->fetchAll();
        $d = [
            'product_title'=> 'This title test',
            'product_price'=>1001
        ];
        $q = Home::table('products')->where('product_id',1)->update($d);
        dd($q);
        $t2 = 'First variable that pass from controller to view';
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