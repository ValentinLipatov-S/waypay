<?php
	$dbconn = pg_connect("
	host = ec2-54-217-245-66.eu-west-1.compute.amazonaws.com
	dbname = d1moulb9o83itl
	user = cfxbiqrrylhabo
	port = 5432
	password = 9df5fc487653ddec6e25d68ccea35d151387bcfe2c64229c5c350f431f3c9781
	") or die('Could not connect: ' . pg_last_error());
	if(isset($_GET('create')))
	{
		$query = "CREATE TABLE users ( id SERIAL, name TEXT NOT NULL, log TEXT NOT NULL, pas TEXT NOT NULL, sum double precision NOT NULL)";	
		$result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
		echo "Создалось";
	}	
	if(isset($_GET('add')))
	{
		$query = "INSERT INTO users (name, log, pas, sum) VALUES ('1', '1', '1', 0)";	
		$result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
		echo "Добавилось";
	}
	if(isset($_GET('view')))
	{
		$query = 'SELECT * FROM users';
		$result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

		echo "<table>\n";

		while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) 
		{
			echo "\t<tr>\n";
				foreach ($line as $col_value) 
				{
					echo "\t\t<td>$col_value</td>\n";
				}
			echo "\t</tr>\n";
		}
		echo "</table>\n";
	}


	pg_free_result($result);
	pg_close($dbconn);
?>