<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style_CRUD.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Add a note</title>
</head>
<body>
    <?php
    session_start();
    $Table = $_POST['table'];

    include '../db.php';
        $mysql = new mysql();
        $mysql->conn();

        ?>
        <form action="READ.php">
            <button type="submit" class="btn btn-success">Вернуться к таблицам</button>
        </form>

        <div class="inputField">
        <form action="CREATE.php" method="post">
            <?php
                $rootconn = new mysqli("localhost","root","root","INFORMATION_SCHEMA");

                $sql = "SELECT COLUMN_NAME
                    FROM INFORMATION_SCHEMA.COLUMNS
                    WHERE TABLE_SCHEMA = 'Graduation_project' AND TABLE_NAME = '$Table'";
                $row = $rootconn->query($sql);

                foreach ($row as $item) {
                    if ($item['COLUMN_NAME'] == 'id') continue; 
                        
            echo '<input type="text" size="40" name = "'.$item['COLUMN_NAME'].'" placeholder="'.$item['COLUMN_NAME'].'"> <br>';
            }

            ?>
            <button type="submit" class="btn btn-success" name="table" value="<?php echo $Table ?>">Сохарнить новые данные</button>

        </form>
        </div>
        <?php

    if (isset($_POST['Record_book_number']) &&  isset($_POST['Full_name']) && isset($_POST['Faculty']) && isset($_POST['Groups']) && isset($_POST['job_id']) && isset($_POST['Year'])) {
    if ($Table == "Student") {
        
            $Record = $_POST['Record_book_number'];
            $Name = $_POST['Full_name'];
            $Facult = $_POST['Faculty'];
            $Group = $_POST['Groups'];
            $job_id = $_POST['job_id'];
            $Year = $_POST['Year'];
        }

            echo $Record, $Name, $Facult, $Group, $job_id, $Year;

            $mysql->$conn->query(

                "INSERT INTO `Student` (`id`, `Record_book_number`, `Full_name`, `Faculty`, `Groups`, `job_id`, `Year`) VALUES (NULL, '$Record', '$Name', '$Facult', '$Group', '$job_id', '$Year')
            ");
             header("Location: READ.php");
        }
    
        
        if (isset($_POST['Full_name']) && isset($_POST['Degree']) && isset($_POST['Rank']) && isset($_POST['Department']) && isset($_POST['Phone']) && isset($_POST['email']) ) { 
        if ($Table == "Teachers") {
           
            $Name = $_POST['Full_name'];
            $Degree = $_POST['Degree'];
            $Rank = $_POST['Rank'];
            $Department= $_POST['Department'];
            $Phone = $_POST['Phone'];
            $email = $_POST['email'];
            }
           
            echo $Name, $Degree, $Rank, $Department, $Phone, $email;

            $mysql->$conn->query(
                
                "INSERT INTO `Teachers` (`id`, `Full_name`, `Degree`, `Rank`, `Department`, `Phone`, `email`) VALUES (NULL, '$Name', '$Degree', '$Rank', '$Department', '$Phone', '$email')
            ");
             header("Location: READ.php");
        }

        if (isset($_POST['teacher_id']) && isset($_POST['Theme_diploma'])) {
        if ($Table == "Subject") {    
            $teacher_id = $_POST['teacher_id'];
            $Theme_diploma = $_POST['Theme_diploma'];
            }
            $mysql->$conn->query(

                "INSERT INTO `Subject` (`id`, `teacher_id`, `Theme_diploma`) VALUES (NULL, '$teacher_id', '$Theme_diploma')
            ");
            header("Location: READ.php");
            }

        if (isset($_POST['Record_book_number']) &&  isset($_POST['State_assessment_exam']) && isset($_POST['Defense_assessment']) && isset($_POST['id_student']) ) {
        if ($Table == "Marks") {
            
            $Record_book_number = $_POST['Record_book_number'];
            $State_assessment_exam = $_POST['State_assessment_exam'];
            $Defense_assessment = $_POST['Defense_assessment'];
            $id_student = $_POST['id_student'];
            }

            $mysql->$conn->query(
                "INSERT INTO `Marks` (`id`, `Record_book_number`, `State_assessment_exam`, `Defense_assessment`, `id_student`) VALUES (NULL, '$Record_book_number', '$State_assessment_exam', '$Defense_assessment', '$id_student')
            ");

            header("Location: READ.php");
            }
    
       
    ?>
</body>
</html>