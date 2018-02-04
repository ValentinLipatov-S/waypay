<?
/*
    $dbconn = pg_connect("
	host     = ec2-54-217-245-66.eu-west-1.compute.amazonaws.com
	dbname   = d1moulb9o83itl
	user     = cfxbiqrrylhabo
	password = 9df5fc487653ddec6e25d68ccea35d151387bcfe2c64229c5c350f431f3c9781
    ")or die('Could not connect: ' . pg_last_error());
    
    $error = "";
    $succs = "";
    
    try 
    {  
        $query = "CREATE TABLE users (
        id SERIAL,
        name TEXT NOT NULL,
        log TEXT NOT NULL,
        pas TEXT NOT NULL,
        sum double precision NOT NULL)";
        $result = pg_query($query) or die(pg_last_error());
        succs .= "Table users is created.<br>";
        
        $query = "CREATE TABLE transaction (
        id SERIAL,
        user_id INT NOT NULL,
        datetime TEXT NOT NULL,
        type TEXT NOT NULL,
        sum double precision NOT NULL,
        status TEXT NOT NULL)";
        $result = pg_query($query) or die(pg_last_error());
        succs .= "Таблицы успешно созданы.<br>";
    } 
    catch (Exception $e) 
    {
        $error .= "Ошибка создания таблиц.<br>";
    }  
    pg_free_result($result);
    pg_close($dbconn);  
    */
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
</body>
</html>