<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style_CRUD.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>UPDATE</title>
</head>
<body>
<?php
    session_start();
    $Table = $_POST['table'];
    if (isset($_POST['id'])) {
    $id = $_POST['id'];
    }
    include '../db.php';
        ?>
         <form action="READ.php">
            <button type="submit" class="btn btn-success">Вернуться к таблицам</button>
        </form>
            <?php
                include 'queryTable.php';

                $rootconn = new mysqli("localhost","root","root","INFORMATION_SCHEMA");
                $row = $rootconn->query("SELECT COLUMN_NAME
                FROM INFORMATION_SCHEMA.COLUMNS
                WHERE TABLE_SCHEMA = 'Graduation_project' AND TABLE_NAME = '$Table'");
                
                $newres = $mysql->query("SELECT * 
                FROM `$Table` WHERE `$Table`.`id` = $id");

               
            ?>
       
        <div class="inputField">
            <form method="post">
            <?php
                include 'UPDATEdata.php';
                include 'UPDATEField.php';
               ?>
               
                
                 <input type="hidden" size="40" name="myid" value="<?php echo $id; ?>"><br>

                <button type="submit" class="btn btn-success" name="table" value="<?php echo $Table ?>">Сохарнить новые данные</button>
               
            </form>
        </div>
        <?php
        if (isset($_POST['Record_book_number']) && isset($_POST['Full_name']) && isset($_POST['Faculty']) && isset($_POST['Groups']) && isset($_POST['job_id']) && isset($_POST['Year']) && isset($_POST['myid'])) {
                if ($Table == "Student") {
                    $Record = $_POST['Record_book_number'];
                    $Name = $_POST['Full_name'];
                    $Facult = $_POST['Faculty'];
                    $Group = $_POST['Groups'];
                    $job_id = $_POST['job_id'];
                    $Year = $_POST['Year'];

                    $newid = $_POST['myid'];
                    
                $mysql->query(
                        "UPDATE `Student` SET `Record_book_number` = '$Record', `Full_name` = '$Name', `Faculty` = '$Facult', `Groups` = '$Group', `job_id` = '$job_id', `Year` = '$Year' WHERE `Student`.`id` = $newid");
                header('Location: READ.php');
                    }
                }
            
            if (isset($_POST['Full_name']) && isset($_POST['Degree']) && isset($_POST['Rank']) && isset($_POST['Department']) && isset($_POST['Phone']) && isset($_POST['email']) && isset($_POST['myid'])) {
                if ($Table == "Teachers") {
                    $Full_name = $_POST['Full_name'];
                    $Degree = $_POST['Degree'];
                    $Rank = $_POST['Rank'];
                    $Department = $_POST['Department'];
                    $Phone = $_POST['Phone'];
                    $email = $_POST['email'];

                    $newid = $_POST['myid'];
                     
                    $mysql->query(
                            "UPDATE `Teachers` SET `Full_name` = '$Full_name', `Degree` = '$Degree', `Rank` = '$Rank', `Department` = '$Department', `Phone` = '$Phone', `email` = '$email' WHERE `Teachers`.`id` = $newid");
                    header('Location: READ.php');
                        }
                    }
            
                if (isset($_POST['teacher_id']) && isset($_POST['Theme_diploma'])) {
                    if ($Table == "Subject") {
                        $teacher_id = $_POST['teacher_id'];
                        $Theme_diploma = $_POST['Theme_diploma'];
                        
        
                        $newid = $_POST['myid'];
                         
                        $mysql->query(
                                "UPDATE `Subject` SET `teacher_id` = '$teacher_id', `Theme_diploma` = '$Theme_diploma' WHERE `Subject`.`id` = $newid");
                        header('Location: READ.php');
                        }
                    }
                
                    if (isset($_POST['Record_book_number']) && isset($_POST['State_assessment_exam']) && isset($_POST['Defense_assessment']) && isset($_POST['id_student'])) {
                        if ($Table == "Marks") {
                            $Record_book_number = $_POST['Record_book_number'];
                            $State_assessment_exam = $_POST['State_assessment_exam'];
                            $Defense_assessment = $_POST['Defense_assessment'];
                            $id_student = $_POST['id_student'];
                            $newid = $_POST['myid'];
                    
                            $mysql->query(
                                "UPDATE `Marks` SET `Record_book_number` = '$Record_book_number', `State_assessment_exam` = '$State_assessment_exam', `Defense_assessment` = '$Defense_assessment', `id_student` = '$id_student' WHERE `Marks`.`id` = $newid");
                            header('Location: READ.php');
                        }
                    }
        ?>
</body>
</html>

