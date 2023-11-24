<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style_user.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <title>Обработка студентов</title>
</head>
<body>
    <?php
    $sqlUser = new mysqli("localhost", "root", "root", "Users");
    
    $res = $sqlUser->query("SELECT * FROM `User` WHERE `User`.`role` != 'admin' ");
    ?>
    <table>
        <tr>
            <th>Login</th>
            <th>Password</th>
            <th>Role</th>
            <th>email</th>
            <th>Действие</th>
        </tr>
    <?php
    
        foreach($res as $item) {
            echo '<tr>';

            echo'<td>'.$item['username'].'</td>
            <td>'.$item['password'].'</td>';
            echo '<td>'.$item['role'].'</td>';
            echo '<td>'.$item['email'].'</td>';
            if ($item['role'] == 'user') {
                echo ' <form method="post">
                <td class="waiting"><button class="btn btn-secondary" type="submit" name="id" value="'.$item['id'].'">Назначить Оператором</button></td>
                </form>';
            }
            else {
                echo '<td><b>Обработан</b></td>';
            }
            echo '</tr>';
        }
    ?>
    </table>
    <?php
    if (isset($_POST['id']))
    {
        $myid = $_POST['id'];
 
        $sqlUser->query("UPDATE `User` SET `role` = 'operator' WHERE `User`.`id` = $myid
        ");    
        header('Location:');   
    }
    ?>
    <form action="READ.php">
        <button class="btn btn-success">Вернуться на главную</button>
    </form>
</body>
</html>