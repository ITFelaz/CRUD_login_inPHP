<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
$sqlUser = new mysqli("localhost", "root", "root", "Users");
$res = $sqlUser->query("SELECT * FROM User");
$k = 0;
foreach($res as $item) {
    if ($item['email'] == $_POST['email']) {
        $_SESSION['email'] = $_POST['email'];
        $k = 1;}
    else continue;
}
if ($k == 0) { echo '<b>Такой почты не существует, повторитe попытку ввода</b>';}
if ($k == 1) {

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST['send'])) {
     $mail = new PHPMailer(true);

     $mail->isSMTP();
     $mail->Host = 'smtp.gmail.com';
     $mail->SMTPAuth = true;
     $mail->Username = 'pvvalik.com@gmail.com';
     $mail->Password = 'xach ymxy idir sdij';
     $mail->SMTPSecure = 'ssl';
     $mail->Port = 465;

     $mail->setFrom('pvvalik.com@gmail.com');
     $mail->addAddress($_POST['email']);

     $mail->isHTML(true);
     $mail->Subject = 'Password recovery';
     $mail->Body = 'Для восстановления пароля перейдите по ссылке: <br> http://localhost:3000/%D0%9B%D0%B0%D0%B1%D0%B0%203/newpass.php';

     $mail->send();

     echo
     "
     <script>
     alert('Успешно');
     document.location.href = 'Recover.php';
     </script>
     ";
}

}
?>