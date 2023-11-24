<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style_login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Введите новый пароль</title>
</head>
<body>
    <div class="hell">
    <form  method="post">
        <input class="newpass" size="30" type="text" name="pass" placeholder="Введите новый пароль"> 
        
        <input size="30" type="text" name="newpass" placeholder="Введите новый пароль еще раз">

        <button class="btn btn-success" type="submit" >Сохранить новый пароль</button>
    </form>
    </div>

    <?php
session_start(); // Начало сессии

$sqlUser = new mysqli("localhost", "root", "root", "Users");

if ($sqlUser->connect_error) {
    die("Ошибка подключения: " . $sqlUser->connect_error);
}

if (isset($_POST['pass']) && isset($_POST['newpass'])) {
    if ($_POST['pass'] == $_POST['newpass']) {
        // Проверка наличия $_SESSION['email'] и защита от SQL-инъекций
        $email = $sqlUser->real_escape_string($_SESSION['email']);
        $result = $sqlUser->query("SELECT * FROM User WHERE email = '$email'");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id = $row['id'];
            $newpass = md5($_POST['pass']); // Более безопасный способ хеширования пароля
            $sqlUser->query("UPDATE `User` SET `password` = '$newpass' WHERE `User`.`id` = $id");
            header('Location: login.php');
        } else {
            echo 'Пользователь не найден';
        }
    } else {
        echo 'Неправильно введен пароль, повторите попытку';
    }
}

$sqlUser->close();
?>

</body>
</html>