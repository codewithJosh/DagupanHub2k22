<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/student_model.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new StudentModel($db);

    $stmt = $items->getStudents();
    $itemCount = $stmt->rowCount();

    if ($itemCount > 0)
    {

        $students = array();
        $students["body"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {

            extract($row);
            $student = array(
                "student_id" => $student_id,
                "student_surname" => $student_surname,
                "student_given_name" => $student_given_name,
                "student_section" => $student_section,
                "student_created" => $student_created
            );
            array_push($students["body"], $student);

        }
        echo json_encode($students);

    }
    else
    {

        http_response_code(404);
        echo json_encode(
            array("messsection" => "No record found.")
        );

    }

?>