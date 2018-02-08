<?php
    $dbconn = pg_connect("
    host     = ec2-54-247-101-191.eu-west-1.compute.amazonaws.com
    dbname   = da7v4a2m26nt7k
    user     = fpfkjitljvvevq
    port     = 5432
    password = cbdd2081c0111b4e059ea5cfd915dec758b49822b905fc03f4eb7974e0894ced
    ")or die('Could not connect: ' . pg_last_error());

switch ($_GET["comand"])
{
    case "create": 
    {
        try 
        {  
            $query = "CREATE TABLE users (
            id TEXT NOT NULL,
			balance double precision NOT NULL, 
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
