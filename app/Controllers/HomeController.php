<?php

namespace App\Controllers;

use App\Models\Home;
use Core\DB;
use PgSql\Lob;

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

        //Update data using query builder
        $d = [
            'product_title'=> 'This title test',
            'product_price'=>1001
        ];
        // $q = Home::table('products')->where('product_id',1)->update($d);

        //Fetch Data Using Raw Query using DB class
        $data3 = DB::query('select * from users')->fetchAll();

        Logs($data3);

        $t2 = 'First variable that pass from controller to view';
        return view('home/index',compact('t2'));
    }

    public function test2(){
        dd($_REQUEST);
        $with = [
            'errors' => $errors??'',
            'inputs' => $_REQUEST
        ];
        return redirect('test/re',['with'=>$with]);
    }

    public function test3(){
        dd($_REQUEST);
        echo 'its work 3';
    }

    public function work(){
        print_r($_GET);
    }
}