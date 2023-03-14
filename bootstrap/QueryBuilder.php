<?php
namespace Core;

class QueryBuilder
{
    private $fields = [];
    private $conditions = [];
    private $order = [];
    private $from = [];
    private $innerJoin = [];
    private $leftJoin = [];
    private $limit;
    private $on = [];
    private $query;
    private $columns = [];
    private $values = [];
    protected $pdo;
    private $dbhost = 'localhost';
	private $dbname = 'insaf_service_db';
	private $dbuser = 'root';
	private $dbpass = '';

    public function __construct()
    {
        try {
			$this->pdo = new \PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname, $this->dbuser, $this->dbpass);
		}catch (\PDOException $e){
			echo "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
    }

    public static function __callStatic($method, $args) {
        $called = get_called_class();
        $class = new $called();
        return $class->$method(...$args);
    }

    public function select(string ...$select) {
        foreach ($select as $arg) {
            $this->fields[] = $arg;
        }
        return $this;
    }

    public function table(string $table, ?string $alias = null){
        $this->from[] = $alias === null ? $table : "$table $alias";
        return $this;
    }

    public function where(string ...$where){
        foreach ($where as $arg) {
            $this->conditions[] = $arg;
        }
        return $this;
    }

    public function limit(int $limit){
        $this->limit = $limit;
        return $this;
    }

    public function orderBy(string ...$order){
        foreach ($order as $arg) {
            $this->order[] = $arg;
        }
        return $this;
    }

    public function innerJoin(string ...$join){
        $this->innerJoin = [];
        foreach ($join as $arg) {
            $this->innerJoin[] = $arg;
        }
        return $this;
    }

    public function leftJoin(string ...$join){
        $this->leftJoin = [];
        foreach ($join as $arg) {
            $this->leftJoin[] = $arg;
        }
        return $this;
    }

    public function on(string ...$col){
        $this->on = [];
        foreach ($col as $arg) {
            $this->on[] = $arg;
        }
        return $this;
    }

    public function fetch() {
        $this->query .= 'SELECT ';
        $this->query .= (count($this->fields)>=1 && !empty($this->fields[0])) ? implode(', ', $this->fields) : "*";
        $this->query .= ' FROM ' . implode(', ', $this->from);
        $this->query .= ($this->leftJoin === [] ? '' : ' LEFT JOIN '. implode(' ON ', $this->leftJoin));
        $this->query .= ($this->innerJoin === [] ? '' : ' INNER JOIN '. implode(' ON ', $this->innerJoin));
        $this->query .= ($this->conditions === [] ? '' : ' WHERE ' . implode(' ', $this->conditions));
        $this->query .= ($this->order === [] ? '' : ' ORDER BY ' . implode(', ', $this->order));
        $this->query .= ($this->limit === null ? '' : ' LIMIT ' . $this->limit);

        $pdoStatement = $this->pdo->prepare($this->query);
        $pdoStatement->execute();
        $data = $pdoStatement->fetch(\PDO::FETCH_ASSOC);
        return $data;
    }

    public function fetchAll() {
        $this->query .= 'SELECT ';
        $this->query .= (count($this->fields)>=1 && !empty($this->fields[0])) ? implode(', ', $this->fields) : "*";
        $this->query .= ' FROM ' . implode(', ', $this->from);
        $this->query .= ($this->leftJoin === [] ? '' : ' LEFT JOIN '. implode(' ON ', $this->leftJoin));
        $this->query .= ($this->innerJoin === [] ? '' : ' INNER JOIN '. implode(' ON ', $this->innerJoin));
        $this->query .= ($this->conditions === [] ? '' : ' WHERE ' . implode(' ', $this->conditions));
        $this->query .= ($this->order === [] ? '' : ' ORDER BY ' . implode(', ', $this->order));
        $this->query .= ($this->limit === null ? '' : ' LIMIT ' . $this->limit);
        $pdoStatement = $this->pdo->prepare($this->query);
        $pdoStatement->execute();
        $data = $pdoStatement->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

    protected function query($query){
        return $this->pdo->query($query);
    }

    public function insert($data,$batch=null): string
    {
        $this->query .= 'INSERT INTO ' . implode(', ', $this->from);
        if($batch==='batch'){
            if (count($data) == count($data, COUNT_RECURSIVE)){
                $this->query = 'Error: One dimention Array! Insert without batch.';
            }else{
                $this->columns = implode(', ',array_keys($data[0]));
                $this->query .= ' ('.$this->columns.') VALUES';
                foreach($data as $d){
                    $this->values = implode("', '",array_values($d));
                    $this->query .= " ('".$this->values."'), ";
                }
                $this->query = rtrim($this->query,', ');
            }
        }else{
            if (count($data) == count($data, COUNT_RECURSIVE)){
                $this->columns = implode(', ',array_keys($data));
                $this->values = implode("', '",array_values($data));
                $this->query .= " (".$this->columns.") VALUES ('".$this->values."')";
            }else{
                $this->query = 'Error: Multidimention Array! Insert as batch.';
            }
        }
        $this->query = $this->pdo->prepare($this->query)->execute();
        return $this->query;
    }

    public function delete()
    {
        $this->query = 'DELETE FROM ' . implode(', ', $this->from) . ($this->conditions === [] ? '' : ' WHERE ' . implode(' AND ', $this->conditions));
        $this->query = $this->pdo->prepare($this->query)->execute();
        return $this->query;
    }

    public function update()
    {
        $this->query = 'UPDATE ' . implode(', ', $this->from)
            . ' SET ' . implode(', ', $this->columns)
            . ($this->conditions === [] ? '' : ' WHERE ' . implode(' AND ', $this->conditions));

        // $this->query = $this->con->prepare($this->query)->execute();
        return $this->query;
    }

    public function set(string ...$columns){
        
        foreach ($columns as $column) {
            $this->columns[] = "$column = :$column";
        }
        dd($this);
        return $this;
    }

}

// $qb = new QueryBuilder();
// echo $qb->select('product_title','title_slug')->table('products','p')->leftJoin('comments c','c.product_id = p.product_id')->fetch();
?>