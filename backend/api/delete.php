<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once '../class/student_model.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new StudentModel($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->student_id = $data->student_id;
    
    if($item->onDeleteStudent())
    {

        echo json_encode("Student deleted.");

    } 
    else
    {

        echo json_encode("Data could not be deleted");

    }
    
?>