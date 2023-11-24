<?php
 include '../db.php';

 
    $k = 0;
    if ($Table == "Student") {
        
        $res = $mysql->query("SELECT Student.id, Student.Record_book_number, Student.Full_name, Student.Faculty, Student.Groups, Subject.Theme_diploma AS 'job_id' , Student.Year
        FROM `Student`
        INNER JOIN Subject ON Student.job_id = Subject.id");
        $k = 1;
    }

    if($Table == "Marks") {

        $res = $mysql->query(
        "SELECT Marks.id, Marks.Record_book_number, Marks.State_assessment_exam, Marks.Defense_assessment, Student.Full_name AS 'id_student'
        FROM `Marks`
        JOIN Student ON Marks.id_student = Student.id");
        $k = 1;
    }

    if ($Table == "Subject") {

        $res = $mysql->query(
            "SELECT Subject.id, Teachers.Full_name AS 'teacher_id', Subject.Theme_diploma
            FROM `Subject`
            JOIN Teachers ON Subject.teacher_id = Teachers.id;");
            $k = 1;
    }

    if ($Table == "Teachers") {
        $res = $mysql->query("SELECT * FROM Teachers;");
        $k = 1;
    }