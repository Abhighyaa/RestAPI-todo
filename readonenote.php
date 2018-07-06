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

//get ID
$note->id = isset($_GET['id']) ? $_GET['id'] : die();

//get note
$note->read_one();
    
	// create array
    $notes_arr=array(
            "id" => $note->id,
            "task" => $note->task,
            "description" => $note->description,
            "duedate" => $note->duedate,
            "label" => $note->label,
            "done" => $note->done,
            "priority" => $note->priority,
            "pin" => $note->pin
        );


     echo json_encode($notes_arr, JSON_PRETTY_PRINT);



?>