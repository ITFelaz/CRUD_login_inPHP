

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style_login.css">
    <title>Регистрация</title>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>    
    
</head>
<body>
    
    <?php
    session_start();
    $error_email = "";
    $error_login = "";
    $error_pass = "";
    $error;
    ?>
    <table>
    
    </table>
    <div class="hello">
        <h2>Регистрация нового пользователя</h2>
        <form method="post">
            <h3>Логин</h3>
            <input class="regField" type="text" size="60" name="login" placeholder="Имя пользователя">
            <span style="color: red"><?=$error_login?></span>
            <h3>Пароль</h3>
            <input class="regField" type="password" size="60" name="pass" placeholder="Пароль">
            <span style="color: red"><?=$error_pass?></span>
            <h3>E-mail</h3>
            <input class="regField" type="email" size="60" name="email" placeholder="Почта">
            <span style="color: red"><?=$error_email?></span>
            <br>

            <div class="g-recaptcha" data-sitekey="6LekeeQoAAAAAC8Jr2YQBG_KW6sg1C3WW0PdDYMI"></div>
            <br/>

            <button type="submit" name="table" value="User" class="reg">Зарегестрироваться</button>
        </form>
        
        <?php
        
        
         $sqlUser = new mysqli("localhost", "root", "root", "Users");

        $res = $sqlUser->query("SELECT * FROM User");
         $k = 1;
         if (isset($_POST['login']) && isset($_POST['pass']) && isset($_POST['email'])) {
            foreach($res as $item)  {
                if ($item['username'] == $_POST['login']) {
                    echo 'Такой пользователь уже существует';
                    $k = 0;
                }
                
            }

            $recaptcha = $_POST['g-recaptcha-response'];
            $secret_key = '6LekeeQoAAAAANlTOGPYr6uPKQz22pIigdXAPTTM';
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret='. $secret_key . '&response=' . $recaptcha;
            $response = file_get_contents($url);
            $response = json_decode($response);

           
            if ($response->success == true) {
                
            if ($k == 1) {
                $sql = 1;
                $login = $_POST['login'];
                $pass = md5($_POST['pass']);
                $checkpass = $_POST['pass'];
                $email = $_POST['email'];
                if ($email == " " || !preg_match("/@/", $email)) {
                    echo 'Введите корректный адрес почты<br>';
                    $sql = 0;
                }
                if (strlen($login) == 0) {
                    echo 'Логин не может быть пустым<br>';
                    $sql = 0;
                }
                if (strlen($checkpass) == 0) {
                    echo 'Пароль не может быть пустым<br>';
                    $sql = 0;
                }
                if ($sql == 1) {
                $sqlUser->query("INSERT INTO `User` (`username`, `password`, `role`, `email`) VALUES ('$login', '$pass', 'user', '$email')");
    
                header('Location: login.php');
            }
            }
            }
            else {
                echo 'Подтвердите, что вы не робот<br>';
               
                $_SESSION['warning'] = $_SESSION['warning'] + 1;
                
                if ($_SESSION['warning'] == 3) {
                    echo '<b>Превышено количество попыток регистрации</b>';
                    $_SESSION['warning'] = 0;
                    
                }
            }

        }  
    
    ?>
</body>
</html>
