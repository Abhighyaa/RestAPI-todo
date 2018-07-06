<?php

class note{
	// database connection and table name
    private $conn;
    private $table_name = "tasks";

     // object properties
    public $id;
    public $task;
    public $description;
    public $duedate;
    public $label;
    public $done;
    public $priority;
    public $pin;


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read notes
    function read(){

    	// select all query
    	$query = "SELECT
              p.id, p.task,p.description, p.duedate, p.label, p.done, p.priority,p.pin
            FROM
                " . $this->table_name . " p
            ORDER BY
                p.duedate	 DESC";

    	// prepare query statement
    	$result = $this->conn->prepare($query);
 
    	// execute query
    	$result->execute();
 
    	return $result;

    }

    function create(){
    	// query to insert record
    	$query = "INSERT INTO
                " . $this->table_name . "
            	SET
                task= :task,description= :description, duedate= :duedate, label= :label, done= :done, priority= :priority,pin= :pin";
 
    // prepare query
    $result = $this->conn->prepare($query);

    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->duedate=htmlspecialchars(strip_tags($this->duedate));
    $this->label=htmlspecialchars(strip_tags($this->label));
    $this->done=htmlspecialchars(strip_tags($this->done));
    $this->priority=htmlspecialchars(strip_tags($this->priority));
    $this->pin=htmlspecialchars(strip_tags($this->pin));
 
    // bind values
    $result->bindParam(":task", $this->task);
    $result->bindParam(":description", $this->description);
    $result->bindParam(":duedate", $this->duedate);
    $result->bindParam(":label", $this->label);
    $result->bindParam(":done", $this->done);
    $result->bindParam(":priority", $this->priority);
    $result->bindParam(":pin", $this->pin);
 
    // execute query
    if($result->execute()){
        return true;
    }
 
 	// Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

    return false;	
    }

	function read_one(){

    	// select all query
    	$query = "SELECT
              p.id, p.task,p.description, p.duedate, p.label, p.done, p.priority,p.pin
            FROM
                " . $this->table_name . " p 
                WHERE p.id = ?
                LIMIT 0,1";

    	// prepare query statement
    	$result = $this->conn->prepare($query);
 
    	//bind id
    	$result->bindParam(1,$this->id);

    	// execute query
    	$result->execute();
 
 		$row = $result->fetch(PDO::FETCH_ASSOC);

 		// set properties
 		$this->id = $row['id'];
        $this->task = $row['task'];
        $this->description = $row['description'];
        $this->duedate = $row['duedate'];
        $this->label = $row['label'];
        $this->done = $row['done'];
        $this->priority = $row['priority'];
        $this->pin = $row['pin'];

    

    }


    function update(){
    	// query to insert record
    	$query = "UPDATE
                " . $this->table_name . "
            	SET
                task= :task,description= :description, duedate= :duedate, label= :label, done= :done, priority= :priority,pin= :pin WHERE id=:id";
 
    // prepare query
    $result = $this->conn->prepare($query);

    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->duedate=htmlspecialchars(strip_tags($this->duedate));
    $this->label=htmlspecialchars(strip_tags($this->label));
    $this->done=htmlspecialchars(strip_tags($this->done));
    $this->priority=htmlspecialchars(strip_tags($this->priority));
    $this->pin=htmlspecialchars(strip_tags($this->pin));
 	$this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind values
    $result->bindParam(":task", $this->task);
    $result->bindParam(":description", $this->description);
    $result->bindParam(":duedate", $this->duedate);
    $result->bindParam(":label", $this->label);
    $result->bindParam(":done", $this->done);
    $result->bindParam(":priority", $this->priority);
    $result->bindParam(":pin", $this->pin);
	 $result->bindParam(":id", $this->id); 
    // execute query
    if($result->execute()){
        return true;
    }
 
 	// Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);
      
    return false;	
    }

    function delete(){
    	$query = "DELETE FROM 
    	" . $this->table_name . "
    	WHERE id = :id"
    	;
    	// prepare query
    $result = $this->conn->prepare($query);

    //sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
     $result->bindParam(":id", $this->id); 

     // execute query
    if($result->execute()){
        return true;
    }
 
 	// Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);
      
    return false;

    }

}

 	

?>