<?

// define 'MySQL' class
class MySQL{
    private $host;
    private $user;
    private $password;
    private $database;
    private $connId;
    // constructor
    function __construct($options=array()){
        if(!is_array($options)){
            throw new Exception('Connection options must be an array');
        }
        foreach($options as $option=>$value){
            if(empty($option)){
                throw new Exception('Connection parameter cannot be empty');
            }
            $this->{$option}=$value;
        }
        $this->connectDb();
    }
    // private 'connectDb()' method
    private function connectDb(){
        if(!$this->connId=mysql_connect($this->host,$this->user,$this->password)){
            throw new Exception('Error connecting to MySQL');
        }
        if(!mysql_select_db($this->database,$this->connId)){
            throw new Exception('Error selecting database');
        }
    }
    // public 'query()' method
    public function query($sql){
        if(!$result=mysql_query($sql)){
            throw new Exception('Error running query '.$sql.''.mysql_error());
        }
        return new Result($this,$result);
    }
}
class Result{
    private $mysql;
    private $result;
    // constructor
    public function __construct($mysql,$result){
        $this->mysql=$mysql;
        $this->result=$result;
    }
    // public 'fetch()' method
    public function fetch(){
        return mysql_fetch_array($this->result,MYSQL_ASSOC);
    }
    // public 'count()' method
    public function count(){
        if(!$rows=mysql_num_rows($this->result)){
            throw new Exception('Error counting rows');
        }
        return $rows;
    }
    // public 'get_insertId()' method
    public function getInsertId(){
        if(!$insId=mysql_insert_id($this->mysql->connId)){
            throw new Exception('Error getting insert ID');
        }
        return $insId;
    }
    // public 'seek()' method
    public function seek($row){
        if(!int($row)&&$row<0){
            throw new Exception('Invalid row parameter');
        }
        if(!$row=mysql_data_seek($this->mysql->connId,$row)){
            throw new Exception('Error seeking row');
        }
        return $row;
    }
    // public 'getAffectedRows()' method
    public function getAffectedRows(){
        if(!$rows=mysql_affected_rows($this->mysql->connId)){
            throw new Exception('Error counting affected rows');
        }
        return $rows;
    }
    // public 'getQueryResource()' method
    public function getQueryResource(){
        return $this->result;
    }
}

?>