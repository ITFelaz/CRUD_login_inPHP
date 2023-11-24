<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style_login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>   
</head>
<body>
    <div class="hello">
        <h2>Добро пожаловать</h2>
    <form action="login.php" method="post">
        <h3>Логин</h3>
        <input class="entranceField" type="text" size="60" name="login" >
        <h3>Пароль</h3>
        <input class="entranceField" type="text" size="60" name="pass">
        <br>
        <div class="g-recaptcha" data-sitekey="6LekeeQoAAAAAC8Jr2YQBG_KW6sg1C3WW0PdDYMI"></div>
            <br/>
        <button class="entrance" type="submit" name="entrance" value="READ"><h2>Вход</h2></button>
        <br>
        <input type="checkbox" name="remember"> <b>Запомнить меня</b>
        </form>
        <form class="registration" action="registration.php">
            <button  type="submit" name="entrance" value="registration"><h2>Регистрация</h2></button>
        </form>

    <div class="Recover">
        <a href="Recover.php" class="Recover" type="submit" name="entrance" value="registration"><h2>Восстановить пароль</h2></a>
    
    </div>

    </div>

    <?php
    $_SESSION['warninglogin'] = 0;
    session_start();

    if (isset($_POST['g-recaptcha-response'])) {
    $recaptcha = $_POST['g-recaptcha-response'];
    $secret_key = '6LekeeQoAAAAANlTOGPYr6uPKQz22pIigdXAPTTM';
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret='. $secret_key . '&response=' . $recaptcha;
    $response = file_get_contents($url);
    $response = json_decode($response);

   
    if ($response->success == true) {
        if (isset($_POST['login']) && isset($_POST['pass']) && isset($_POST['entrance'])) {
            $login = $_POST['login'];
            $pass = md5($_POST['pass']);
            $web = $_POST['entrance'];
    
        $sqlUser = new mysqli("localhost", "root", "root", "Users");
        if ($web == 'READ') {
        $res = $sqlUser->query("SELECT User.role FROM User WHERE User.username = '$login' and User.password = '$pass'");
        $rol = "";
            foreach($res as $item) {
                
                $rol = $item['role'];
            }
            
            if ($rol == "admin" ) {  
                $_SESSION['role'] = $rol;
                echo $rol;
                header('Location: '.$web.'.php'); 
                }
            else echo "Пользователя не существует";
            if ($rol == 'user') {
                $_SESSION['role'] = $rol;
                header('Location: home.php');
            }
            if ( $rol == "operator") {
                $_SESSION['role'] = $rol;
                header('Location: ../Лаба 1/index.php');
            }
        }
        }
    
        if (isset($web)) {
        if ($web == 'registration') {
            $warning = 0;
            $_SESSION['warning'] = $warning; 
            header('Location: registration.php');
        }
    }
    }
    else {
        $_SESSION['warninglogin'] += 1;
        echo 'Подтвердите, что вы не робот<br>';
        
        if ($_SESSION['warninglogin'] == 3) {
            echo '<b>Превышен лимит входа</b>';
            $_SESSION['warninglogin'] = 0 ;
        }
    }
}
    ?>
</body>
</html>