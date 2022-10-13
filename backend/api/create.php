<?php

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
    header('Content-Type: application/json');

    $method = $_SERVER['REQUEST_METHOD'];

    if ($method == "OPTIONS") 
    {

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
        header("HTTP/1.1 200 OK");
        die();

    }

    include_once '../config/database.php';
    include_once '../class/student_model.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new StudentModel($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->student_surname = $data->student_surname;
    $item->student_given_name = $data->student_given_name;
    $item->student_section = $data->student_section;
    $item->student_created = date('Y-m-d H:i:s');
    
    if($item->onCreateStudent())
    {

        echo 'Student created successfully.';

    }
    else
    {

        echo 'Student could not be created.';

    }

?>