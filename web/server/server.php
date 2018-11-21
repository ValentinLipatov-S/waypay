<?php
header('Content-Type: text/html; charset= utf-8');
$link = mysqli_connect("127.0.0.1", "u496631331_val", "dfktynby123456", "u496631331_val");

if (mysqli_connect_errno()) 
{
    printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    exit();
}

switch($_GET['comand'])
{
    case 'add': {
        if(isset($_GET['name']) and
        isset($_GET['autor']) and
        isset($_GET['year']) and
        isset($_GET['isbn']) and
        isset($_GET['price']))
        {
            $query = "INSERT INTO item (name, autor, year, isbn, price) 
            VALUES ('$_GET[name]', '$_GET[autor]', '$_GET[year]', '$_GET[isbn]', '$_GET[price]')";
            $result = mysqli_query ($link, $query);
             if ($result) {
                echo "Данные успешно добавлены в таблицу";
            } else {
                echo "Произошла ошибка";
            }
        }
    } break;
    
    case 'delete': {
        if(isset($_GET['id']))
        {
            $query = "DELETE FROM item WHERE id = '$_GET[id]'";
            $result = mysqli_query ($link, $query);
        }
    } break;
    case 'get': {
        $query = "SELECT * FROM item WHERE 1=1 ";
		
		switch($_GET['sex'])
		{
			case "man": 
				$query  .= "and sex='man'";
			break;
			case "woman": 
				$query  .= "and sex='woman'";
			break;	
			default: 
				$query  .= "and sex='man'";
			break;
		}
		
		if(isset($_GET['type']))
		{
			$type = "";
			$arr_type = explode(',', $_GET['type']);
			foreach ($arr_type as $value) {
				if(strlen($type) == 0)
					$type  .= "type='" . $value . "'";
				else $type  .= " or type='" . $value . "'";
			}
			if(strlen($type) != 0)
			$query .= " and (" .$type . ")";
		}
		
		if(isset($_GET['size']))
		{
			$size = "";
			$arr_size = explode( ',', $_GET['size']);
			foreach ($arr_size as $value) {
				if(strlen($size) == 0)
					$size  .= "size='" . $value . "'";
				else $size  .= " or size='" . $value . "'";
			}
			if(strlen($size) != 0)
				$query .= " and (" .$size . ")";
		}
		
		if(isset($_GET['condition']))
		{
			$condition = "";
			$arr_condition = explode( ',', $_GET['condition']);
			foreach ($arr_condition as $value) {
				if(strlen($condition) == 0)
					$condition  .= "cond='" . $value . "'";
				else $condition  .= " or cond='" . $value . "'";
			}
			if(strlen($condition) != 0)
				$query .= " and (" .$condition . ")";
		}
		
		if(isset($_GET['at'])) $query .= " and price >= $_GET[at] ";
        if(isset($_GET['to'])) $query .= " and price <= $_GET[to] ";
		
        if(isset($_GET['query'])) 
			$query .= " and (LOWER(name) LIKE '%". strtolower($_GET['query'])  ."%' or LOWER(model) LIKE '%". strtolower($_GET['query'])  ."%') ";
		
		switch($_GET['sort'])
		{			
			case "dateup": 
				$query  .= " ORDER by date ASC";
			break;
			case "datedown": 
				$query  .= " ORDER by date DESC";
			break;
			case "priceup": 
				$query  .= " ORDER by price ASC";
			break;
			case "pricedown": 
				$query  .= " ORDER by price DESC";
			break;	
			default: 
				$query  .= " ORDER by date ASC";
			break;
		}
        
		if(isset($_GET['start']) and isset($_GET['length']))
			$query  .= " LIMIT " . $_GET['start'] . ", " . $_GET['length'];
		
		$otv;
        $result = mysqli_query($link, $query);    
		
        if ($result) {
            while($line = mysqli_fetch_array($result, MYSQLI_ASSOC))
            { 
				$otv[$line['id']] = $line;
			}
        }
        else {
            echo mysql_error();
        }
		
		$json = json_encode($otv);
		echo $json;

    } break;
    default: {
        echo 'Неизвестная команда';
    } break;
}
mysqli_close($link);
?>