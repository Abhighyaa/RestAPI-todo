<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once 'config/database.php';
 
// instantiate note object
include_once 'notes.php';

$database = new Database();
$db = $database->getConnection();
 
$note = new note($db);

// get raw posted data
$data = json_decode(file_get_contents("php://input"));

// set object property values
$note->id=$data->id;

// delete the note
if($note->delete()){
    echo '{';
        echo '"message": "Note was deleted."';
    echo '}';
}
 
// if unable to delete the note, tell the user
else{
    echo '{';
        echo '"message": "Unable to delete note."';
    echo '}';
}
?>