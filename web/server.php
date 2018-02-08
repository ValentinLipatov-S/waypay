<?php
$dbconn = pg_connect("
	host     = ec2-54-217-245-66.eu-west-1.compute.amazonaws.com
	dbname   = d1moulb9o83itl
	user     = cfxbiqrrylhabo
	port	 = 5432
	password = 9df5fc487653ddec6e25d68ccea35d151387bcfe2c64229c5c350f431f3c9781
")or die('Could not connect: ' . pg_last_error());

switch ($_GET["comand"])
{
    case "create": 
    {
        try 
        {  
            $query = "CREATE TABLE users (
            id SERIAL,
			balance FLOAT NOT NULL, 
            first_name TEXT NOT NULL,
            last_name TEXT NOT NULL,
            screen_name TEXT NOT NULL,
			sex int NOT NULL,
			bdate TEXT NOT NULL,
			photo_big TEXT NOT NULL,
            country TEXT NOT NULL)";
            $result = pg_query($query) or die(pg_last_error());

			$query = "CREATE TABLE transactions (
            id SERIAL,
            user_id INT NOT NULL,
            sum FLOAT NOT NULL,
			type TEXT NOT NULL,
			status TEXT NOT NULL,
			comment TEXT NOT NULL)";
            $result = pg_query($query) or die(pg_last_error());
			
			echo 'succes';
        } 
        catch (Exception $e) 
        {
            echo "error";
        }    
    } break; 
}
pg_free_result($result);
pg_close($dbconn);
?>
