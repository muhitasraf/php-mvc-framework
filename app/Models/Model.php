<?php
    
namespace App\Models;

use Core\QueryBuilder;

class Model extends QueryBuilder{
    protected $pdo;
    private $dbhost = 'localhost';
	private $dbname = 'insaf_service_db';
	private $dbuser = 'root';
	private $dbpass = '';
    public function __construct() {
        try {
			$this->pdo = new \PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname, $this->dbuser, $this->dbpass);
		}catch (\PDOException $e){
			echo "Error!: " . $e->getMessage() . " Error Code: " .$e->getCode(). "<br/>";
			die();
		}
    }
}
