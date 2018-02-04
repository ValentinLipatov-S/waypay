<?php 
    header("Content-Type: text/html; charset=UTF-8");
    //include("autorization.php");

    if ($aut) 
    {
        header('Location: action.php');
        exit;
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE10">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>WayPay</title>
</head>

<body>
    <p style = "color: green;"><? echo $succs; ?></p>
    <p style = "color: red;"><? echo $error; ?></p>
    <form method="post">
        <p>Авторизация</p>
        <input type="text" name="l_log" autocomplete="off" placeholder="Логин">
        <input type="password" name="l_pas" autocomplete="off" placeholder="Пароль">
        <input type="submit" name="login" value="Войти">
        <p>Регистрация</p>
        <input type="text" name="s_name" autocomplete="off" placeholder="Имя">
        <input type="text" name="s_log" autocomplete="off" placeholder="Логин">
        <input type="password" name="s_pas" autocomplete="off" placeholder="Пароль">
        <input type="submit" name="signin" value="Регистрация">
    </form>
</body>
</html>
