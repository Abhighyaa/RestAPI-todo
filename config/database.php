<?php


class Database
{
	
	
    // specify your own database credentials
   	private $SERVER = 'localhost';
   	private $username = 'root';
	private $passwd = 'root';
	private $dbname = 'todo';
	public $conn;

    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->passwd);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }

}

?>
