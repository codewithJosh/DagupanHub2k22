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

    $item->student_id = isset($_GET['student_id']) ? $_GET['student_id'] : die();
  
    $item->getSingleStudent();

    if($item->student_surname != null)
    {

        // create array
        $student = array(
            "student_id" =>  $item->student_id,
            "student_surname" => $item->student_surname,
            "student_given_name" => $item->student_given_name,
            "student_section" => $item->student_section,
            "student_created" => $item->student_created
        );
      
        http_response_code(200);
        echo json_encode($student);

    }
    else
    {

        http_response_code(404);
        echo json_encode("Student not found.");

    }

?>