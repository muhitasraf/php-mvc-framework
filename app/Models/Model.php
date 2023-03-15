<?php
    
namespace App\Models;

use Core\QueryBuilder;

class Model extends QueryBuilder{
    protected $pdo;

    public function __construct() {
		$this->pdo = self::instance();
    }
}
