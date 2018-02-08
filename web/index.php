<?php 
    session_start();
    
    $dbconn = pg_connect("
    host     = ec2-54-75-228-85.eu-west-1.compute.amazonaws.com
    dbname   = ddrgbsg3qokpc2
    user     = kbpivkrmvdkauu
    password = 0p_EhxRACs9Q2b96sZ5Fs3zK_m
    ")or die('Could not connect: ' . pg_last_error());
    
    if (!isset($_SESSION['user_info']))
    {
        $client_id = '6361837';
        $client_secret = '9pohMcwaxBYL02WMTR3M';
        $redirect_uri = 'https://waypay.herokuapp.com/';

        $url = 'http://oauth.vk.com/authorize';
        
        if (isset($_GET['code'])) 
        {
            $params = array(
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'code' => $_GET['code'],
                'redirect_uri' => $redirect_uri
            );

            $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);

            if (isset($token['access_token'])) 
            {
                $params = array(
                    'user_ids'         => $token['user_id'],
                    'fields'       => 'id,first_name,last_name,screen_name,sex,bdate,photo_big,country',
                    'access_token' => $token['access_token'],
                    'v' => '5.71',
                    'name_case' => 'Nom'
                );

                $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);

                if (isset($userInfo['response'][0]['id'])) 
                {
                    $userInfo = $userInfo['response'][0];
                    /* Добавление или обновление данных в таблице Users*/
                    
            
                    $query = "SELECT * FROM users WHERE id = ' $userInfo[id]'";
                    $result = pg_query($query) or die(pg_last_error());
                    if(pg_num_rows($result) > 0)
                    {
                        $query = "UPDATE users SET id = '$userInfo[id]', 
                        first_name = '$userInfo[first_name]',
                        last_name =  '$userInfo[last_name]',
                        screen_name =  '$userInfo[screen_name]', 
                        sex = '$userInfo[sex]',
                        bdate =  '$userInfo[bdate]',
                        photo_big =  '$userInfo[photo_big]',
                        country =  '$userInfo[country][title]' 
                        
                         WHERE id = '$userInfo[id]'";
                         
						$result = pg_query($query) or die(pg_last_error());	
                    }
                    else
                    {
                        $query = "INSERT INTO users (id, balance, first_name, last_name, screen_name, sex, bdate, photo_big, country) 
                        VALUES ('$userInfo[id]', '0.0', '$userInfo[first_name]', '$userInfo[last_name]', '$userInfo[screen_name]', 
                        '$userInfo[sex]', '$userInfo[bdate]', '$userInfo[photo_big]', '$userInfo[country][title]')";
						$result = pg_query($query) or die(pg_last_error());
                    }
                                
                    $_SESSION['user_info'] = $userInfo;
                    header("location: " .  $redirect_uri);
                }
            }
        }
        else 
        {   
            $params = array(
            'client_id'     => $client_id,
            'redirect_uri'  => $redirect_uri,
            'response_type' => 'code'
            );
        
             header("location: " . $url . '?' . urldecode(http_build_query($params)));
        }
    }
    else 
    { 
        if(isset($_POST['logout']))
        {
            unset($_SESSION['user_info']);
            session_destroy();
        }
        
        $query = "SELECT * FROM users WHERE id = '$_SESSION[user_info][id]'; LIMIT 1";
        $result = pg_query($query) or die(pg_last_error());
        if(pg_num_rows($result) > 0)
        {
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
            $_SESSION['user_info']['id'] = $line["id"];
            $_SESSION['user_info']['first_name'] = $line["first_name"];
            $_SESSION['user_info']['last_name'] = $line["last_name"];
            $_SESSION['user_info']['screen_name'] = $line["screen_name"];
            $_SESSION['user_info']['sex'] = $line["sex"];
            $_SESSION['user_info']['bdate'] = $line["bdate"];
            $_SESSION['user_info']['photo_big'] = $line["photo_big"];
            $_SESSION['user_info']['country']['title'] = $line["country"]; 
        }
    }
    pg_free_result($result);
    pg_close($dbconn);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>Change from box to list</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="wrapper">

        <header>
            <div class="autor">
                <div class="user_container flex_container_row_stretch">
                    <div style="width: 75px; height: 75px; background: url('<?php echo $_SESSION['user_info']['photo_big']; ?>'); background-size: cover; border-radius: 50%;">
                    </div>
                    <div style="flex: 1 1; padding: 0px 0px 0px 10px;">
                        <div>
                            <text class="name" style="display: flex;"><?php echo $_SESSION['user_info']['first_name']; ?>&nbsp;<?php echo $_SESSION['user_info']['last_name'];?></text>
                            <text style="display: flex; font-size: 11px;"><?php echo $_SESSION['user_info']['id']; ?></text>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!--<div class="main loadingbar">
           
            <input type="submit" class="text" value="Р С‘РЎРѓРЎвЂљР С•РЎР‚Р С‘РЎРЏ Р С•Р С—Р ВµРЎР‚Р В°РЎвЂ Р С‘Р в„–" style = "background: white;"/>
        </div>-->
        <div class="flex_container_row_stretch">
            <input style = "flex: 1 1;" type="text" class="text" placeholder="Сумма" />
            <input style = "flex: 1 1;" type="submit" class="text" value="Пополнить" />
            <input style = "flex: 1 1;" type="submit" class="text" value="Снять" />
        </div>
        <div class="main loadingbar">
            <input type="text" class="text" placeholder="Поиск" />
        </div>
        <div class="container">
            <div class="user_container flex_container_row_stretch">
                
                
                
                <div class="user_container flex_container_row_stretch">
                    <div style="width: 75px; height: 75px; background: url('<?php echo $_SESSION['user_info']['photo_big']; ?>'); background-size: cover; border-radius: 50%;">
                    </div>
                    <div style="flex: 1 1; padding: 0px 0px 0px 10px;">
                        <div>
                            <text class="name" style="display: flex;"><?php echo $_SESSION['user_info']['first_name']; ?>&nbsp;<?php echo $_SESSION['user_info']['last_name'];?></text>
                            <text style="display: flex; font-size: 11px;"><?php echo $_SESSION['user_info']['id']; ?></text>
                        </div>
                    </div>
                </div>
                
                
                
            </div>

        </div>
        <div class="loadingbar lodingblock"></div>
    </div>
</body>

</html>