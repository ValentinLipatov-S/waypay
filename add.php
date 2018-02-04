<?
    $dbconn = pg_connect("
	host     = ec2-54-217-245-66.eu-west-1.compute.amazonaws.com
	dbname   = d1moulb9o83itl
	user     = cfxbiqrrylhabo
	password = 9df5fc487653ddec6e25d68ccea35d151387bcfe2c64229c5c350f431f3c9781
    ")or die('Could not connect: ' . pg_last_error());
    
    $error = "";
    $succs = "";
    
    if(isset($_GET['add']) and isset($_GET['id']) and isset($_GET['sum'])) 
    {    
        $query = "SELECT * FROM users WHERE id = '$_GET[id]' LIMIT 1";
        $result = pg_query($query) or die(pg_last_error());
        if(pg_num_rows($result) > 0)
        {
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
            $ballans = $line["sum"];
            $name = $line["name"];
            $ballans = $ballans + $_GET['sum'];
            
            $query = "UPDATE users WHERE id = '$_GET[id]' set sum = '$ballans'";
            $result = pg_query($query) or die(pg_last_error());
             
            $succs .=  $name . " добавлено " . $ballans . ".<br>";
        }
        else $error .= "Неверный id.<br>";
    }
    else $error .= "Заполнети все поля.<br>";
    
    pg_free_result($result);
    pg_close($dbconn);  
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
    <form method="get">
        <input type = "number" name = "id" autocomplete="off" placeholder = "id">
        <input type = "number" name = "sum" autocomplete="off" placeholder = "Сумма">
        <input type = "submit" name = "add" value = "Добавить">
    </form>   
</body>
</html>