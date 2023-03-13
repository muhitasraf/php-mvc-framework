<?php
class Database{
	private $dbhost = 'localhost';
	private $dbname = 'insaf_service_db';
	private $dbuser = 'root';
	private $dbpass = '';
	private $con;

	public function __construct(){
		try {
			$this->con = new PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname, $this->dbuser, $this->dbpass);
		}catch (PDOException $e){
			echo "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}

	public function getCon() {
		return $this->con;
	}
}

?>