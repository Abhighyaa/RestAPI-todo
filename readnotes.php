<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once 'config/database.php';
include_once 'notes.php';

// instantiate database and note object
$database = new Database();
$db = $database->getConnection();
	
// initialize object
$note = new note($db);

// query products
$result = $note->read();

$num = $result->rowCount();
	
// check if any note
if($num>0){

	 // notes array
    $notes_arr=array();
    $notes_arr["notes"]=array();

   	while ($row = $result->fetch(PDO::FETCH_ASSOC)){

    	// extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        $note_item=array(
            "id" => $id,
            "task" => $task,
            "description" => $description,
            "duedate" => $duedate,
            "label" => $label,
            "done" => $done,
            "priority" => $priority,
            "pin" => $pin
        );
        array_push($notes_arr["notes"], $note_item);
    }

     echo json_encode($notes_arr, JSON_PRETTY_PRINT);

}
else{
    echo json_encode(
        array("message" => "No notes found.")
    );
}

?>