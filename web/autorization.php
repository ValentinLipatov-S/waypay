<?php 
    $dbconn = pg_connect("
	host     = ec2-54-217-245-66.eu-west-1.compute.amazonaws.com
	dbname   = d1moulb9o83itl
	user     = cfxbiqrrylhabo
	password = 9df5fc487653ddec6e25d68ccea35d151387bcfe2c64229c5c350f431f3c9781
    ")or die('Could not connect: ' . pg_last_error());
    
    header("Content-Type: text/html; charset=UTF-8");

    session_start();
    $aut = false;
    $ballans = 0;
    $name = "";    
    $error = "";
    $succs = "";  
    $log = "";
    $pas = "";
    
    if (isset($_COOKIE['log']) and isset($_COOKIE['pas']))
    {   
        $log = $_COOKIE['log'];
        $pas = $_COOKIE['pas'];

        $query = "SELECT * FROM users WHERE log = '$log' LIMIT 1";
        $result = pg_query($query) or die(pg_last_error());
        if(pg_num_rows($result) > 0)
        {
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
            if($line["pas"] == $pas)
            {
                setcookie("log", $log, time() + 60 * 60 * 24 * 30);
                setcookie("pas", $pas, time() + 60 * 60 * 24 * 30);
                $aut = true;
                $ballans = $line["sum"];
                $name = $line["name"];
                
                $succs .= "Успешная авторизация.<br>";
            }
            else $error .= "Неверный логин или пароль.<br>";
        }
        else $error .= "Неверный логин или пароль.<br>";
    }
   
    if (isset($_POST['log']) and isset($_POST['pas']))
    {
        $log = $_POST['log'];
        $pas = $_POST['pas'];
 
        if(isset($_POST['signin']) and isset($_POST['name'])) 
        {
            if(strlen($_POST['name']) > 2 and strlen($_POST['name']) < 30 and 
                strlen($log) > 5 and strlen($log) < 30 and 
                strlen($pas) > 5 and strlen($pas) < 30)
            {
                $query = "SELECT * FROM users WHERE log = '$log' LIMIT 1";
                $result = pg_query($query) or die(pg_last_error());
                if(pg_num_rows($result) == 0)
                {
                    $query = "INSERT INTO users (name, log, pas, sum) VALUES ('$_POST[name]', '$log', '$pas', 0)";
                    $result = pg_query($query) or die(pg_last_error());
                    
                    setcookie("log", $log, time() + 60 * 60 * 24 * 30);
                    setcookie("pas", $pas, time() + 60 * 60 * 24 * 30);
                    $aut = true;
                    $ballans = 0;
                    $name = $_POST['name'];
                    
                    $succs .= "Пользователь зарегестрирован.<br>";
                }
                else $error .= "Данный логин занят.<br>";
            }
            else $error .= "Длинна логина и пароля - от 5 до 30 символов, длинна имени - от 2 до 30 символов.<br>";
        }
        else $error .= "Заполните все поля.<br>";
        
        if(isset($_POST['login'])) 
        {    
            $query = "SELECT * FROM users WHERE log = '$log' LIMIT 1";
            $result = pg_query($query) or die(pg_last_error());
            if(pg_num_rows($result) > 0)
            {
                $line = pg_fetch_array($result, null, PGSQL_ASSOC);
                if($line["pas"] == $pas)
                {
                    setcookie("log", $log, time() + 60 * 60 * 24 * 30);
                    setcookie("pas", $pas, time() + 60 * 60 * 24 * 30);
                    $aut = true;
                    $ballans = $line["sum"];
                    $name = $line["name"];
                    
                    $succs .= "Успешная авторизация.<br>";
                }
                else $error .= "Неверный логин или пароль.<br>";
            }
            else $error .= "Неверный логин или пароль.<br>";
        }
        
    }
    echo "1";
    echo "2";
    
    pg_free_result($result);
    pg_close($dbconn);
?>
