<?php 
    header("Content-Type: text/html; charset=UTF-8");
    include("autorization.php");
    if(isset($_POST['add']) and isset($_POST['sum'])) 
    {
        $url = "https://money.yandex.ru/quickpay/confirm.xml/?";

        $param;

        $param["receiver"] = "410016058518782";
        $param["quickpay-form"] = "donate";
        $param["targets"] = "Транзакция";
        $param["paymentType"] = "AC";
        $param["sum"] = $_POST['sum'] + (1.00 + 0.02);

        $param["formcomment"] = "Липатов Валентин Сергеевич";
        $param["label"] = "Пополнение 84521";
        $param["comment"] = "";
        $param["successURL"] = "";

        $get = "";

        foreach ($param as $key => $value)$get .= $key . '=' . urlencode($value) . '&';     
        header('Location: ' . $url . $get);
        exit;
    }
    
    if(isset($_POST['exit']))
    {
        setcookie("log", "", time() - 3600*24*30*12, "/"); 
        setcookie("pas", "", time() - 3600*24*30*12, "/"); 
    }    
    if ($aut == false) 
    {
        //header('Location: index.php');
        //exit;
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
            <p>Ваш баланс: <? echo $ballans; ?> руб.</p>
            <input type = "number" name = "sum" autocomplete="off" placeholder = "Сумма">
            <input type = "submit" name = "add" value = "Пополнить">
            <input type = "submit" name = "exit" value = "Выйти">
        </form>   
    </body>
</html>
