<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 


// get database connection
include_once 'config/database.php';
 
// instantiate note object
include_once 'notes.php';

$database = new Database();
$db = $database->getConnection();
 
$note = new note($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set object property values
$note->task = $data->task;
$note->description = $data->description;
$note->duedate = $data->duedate;
$note->label = $data->label;
$note->done = $data->done;
$note->priority = $data->priority;
$note->pin = $data->pin;

// create the note
if($note->create()){
    echo '{';
        echo '"message": "Note was created."';
    echo '}';
}
 
// if unable to create the note, tell the user
else{
    echo '{';
        echo '"message": "Unable to create note."';
    echo '}';
} 

?>