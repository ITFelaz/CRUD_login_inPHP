<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style_CRUD.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>CRUD</title>
</head>
<body>
    <?php 
    session_start();
    $role = $_SESSION['role'];
    include '../db.php';
  
    ?>
    <div class="TableButtons">
        <form  class="View" action="READ.php" method="post">
            <button type="submit" class="btn btn-success" name="table" value="Student">Таблица &#34;Студенты&#34;</button>
            <button type="submit" class="btn btn-success" name="table" value="Teachers">Таблица &#34;Преподаватели&#34;</button>
            <button type="submit" class="btn btn-success" name="table" value="Subject">Таблица &#34;Тема диплома&#34;</button>
            <button type="submit" class="btn btn-success" name="table" value="Marks" >Таблица &#34;Оценки&#34;</button>
        </form>    
        <form class="View" action="../Лаба 1/index.php">
            <?php
                 if ($role == 'admin') { 
            echo '<button type="submit" class="btn btn-success" > Открыть ведомость </button>';
                 }
            ?>
        </form>
        <div class="TableButtons">
            <form action="login.php">
                <button class="btn btn-danger">Выйти</button>
            </form>
            <form action="users.php">
                <br>
                <?php if ($role == 'admin')
            echo '<button class="btn btn-success">Открыть обработку пользователей</button>';
            ?>
            </form>
        </div>
    </div>


    <?php 
    
    $id = null;
    $res = null;
    $Table = null;
    if (isset($_POST['table'])) {
        $Table = $_POST['table'];
        $_SESSION['table'] = $Table; 
    }


    $rootconn = new mysqli("localhost","root","root","INFORMATION_SCHEMA");

    $sql = "SELECT COLUMN_NAME
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_SCHEMA = 'Graduation_project' AND TABLE_NAME = '$Table'";
        
    $row = $rootconn->query($sql);

    
 ?>
    <table>
        <tr>
 <?php
 $res = null;
    include 'queryTable.php';

    if ($res == null) echo "<h1>Выберите таблицу</h1>";
    else{

    if ($Table == 'Student') {
        echo'
        <th>Факультет</th>
        <th>ФИО</th>
        <th>Группа</th>
        <th>Тема диплома</th>
        <th>Номер зачетной книжки</th>
        <th>Год поступления</th>
        <th>DROP</th>
        <th>EDIT</th>';
    }

    if ($Table == 'Subject') {
        echo'
        <th>ФИО преподавателя</th>
        <th>Тема диплома</th>
        <th>DROP</th>
        <th>EDIT</th>';
    }

    if ($Table == 'Teachers') {
        echo'
        <th>Научная степень</th>
        <th>Кафедрв</th>
        <th>Email</th>
        <th>ФИО</th>
        <th>Номер телефона</th>
        <th>Должность</th>
        <th>DROP</th>
        <th>EDIT</th>';
    }

    if ($Table == 'Marks') {
        echo'
        <th>Оценка на защите</th>
        <th>ФИО Студента</th>
        <th>Номер зачетной книжки</th>
        <th>Оценка на гос. экзамене</th>
        <th>DROP</th>
        <th>EDIT</th>';
    }


    foreach($res as $item) {
        echo '<tr>';
        foreach ($row as $rows) {
            if ($rows['COLUMN_NAME'] == 'id') { 
                $id = $item[$rows['COLUMN_NAME']];
                continue;}
                
            echo '<td>'.$item[$rows['COLUMN_NAME']].'</td>';
        }
        ?>
        <form method="post">
            <?php
            if ($role == 'admin') { 
            echo '<td><button class="btn" name="isdel" value="'.$id.'"><i class="fa fa-trash"></i>Удалить</button></td>
            <input type="hidden" name="table" value="'.$Table.'">
            ';
            }
            ?>
        </form>
        <form action="UPDATE.php" method="post">
        <?php
        $isdel = 0;
            if ($role == 'admin') { 
            echo '<td><button class="btn" name="table" value="'.$Table.'"><i class="fa fa-bars"></i> Редактировать</button>
            <input type="hidden" name="id" value="'.$id.'">
            <input type="hidden" name="isdel" value="1">  ';  
        }
        ?>
        </td>
        </form>
            </tr>
        
        <?php
    }
    }

    //Удаление
    if (isset($_POST['isdel']) && isset($_POST['table'])) {
    $id = $_POST['isdel'];
    $Table = $_POST['table'];
    $isdel = $_POST['isdel'];
}

    if ($Table == 'Marks' && $isdel == 1) {
    $mysql->query(
        "DELETE FROM Marks WHERE `Marks`.`id` = $id");
    }

    if ($Table == 'Student' && $isdel == 1) {
        $mysql->query(
            "DELETE FROM Student WHERE `Student`.`id` = $id");
        }

    if ($Table == 'Subject' && $isdel == 1) {
        $mysql->query(
        "DELETE FROM `Subject` WHERE `Subject`.`id` = $id");
        }

    if ($Table == 'Teachers' && $isdel == 1) {
        $mysql->query(
        "DELETE FROM Teachers WHERE `Teachers`.`id` = $id");
        }
    ?>
    </table>

    <?php
    if ($k != 0) {
        ?>
        <form action="CREATE.php" method="post">
            <?php
             if ($role == 'admin') { ?>
                <button type="submit" class="btn btn-success create" name="table" value="<?php echo $Table ?>">Добавить запись</button>
            <?php }
            ?>
        </form>
        <?php
    }
    ?>
</body>
</html>