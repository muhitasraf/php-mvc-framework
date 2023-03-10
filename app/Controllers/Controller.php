<?php
    
namespace App\Controllers;

class Controller {
    public function __construct() {

    }
    
    private function verifyCSRFToken()
    {
        // if(isset($_REQUEST['token'])) {
        //     if($_REQUEST['token'] != $_SESSION['token'] ) {
        //         echo ("The page has expired, due to inactivity.");
        //     }
        // }
    }

    public function setJson($data){
        return json_encode($data);
    }
}
