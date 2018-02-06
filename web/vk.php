<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title></title>
</head>
<body>
    <?php

    $client_id = '6361837'; // ID приложения
    $client_secret = '9pohMcwaxBYL02WMTR3M'; // Защищённый ключ
    $redirect_uri = 'https://waypay.herokuapp.com/vk.php'; // Адрес сайта

    $url = 'http://oauth.vk.com/authorize';

    $params = array(
        'client_id'     => $client_id,
        'redirect_uri'  => $redirect_uri,
        'response_type' => 'code'
    );

    echo $link = '<p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Аутентификация через ВКонтакте</a></p>';

if (isset($_GET['code'])) {
		
		$result = false;
		$params = array(
			'client_id' => $client_id,
			'client_secret' => $client_secret,
			'code' => $_GET['code'],
			'redirect_uri' => $redirect_uri
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params)));
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		$token = json_decode(curl_exec($ch), true);   
		curl_close($ch);
	
        $params = array(
            'user_ids'     => $token['user_id'],
            'fields'       => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big,city,verified',
			'name_case' => 'nom',
			'v' => '5.8'
        );
		
		print_r ($token);
		
		if (isset($token['access_token'])) {
			$params = array(
				'user_ids'         => $token['user_id'],
				'fields'       => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big',
				'access_token' => $token['access_token']
			);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'https://oauth.vk.com/user.get' . '?' . urldecode(http_build_query($params)));
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
			$userInfo = json_decode(curl_exec($ch), true);   
			curl_close($ch);
			
			print_r ($userInfo);
		
			if (isset($userInfo['response'][0]['uid'])) {
				$userInfo = $userInfo['response'][0];
				$result = true;
			}
		}
		
		print_r ($userInfo);
		
		
    if ($result) {
        echo "Социальный ID пользователя: " . $userInfo['uid'] . '<br />';
        echo "Имя пользователя: " . $userInfo['first_name'] . '<br />';
        echo "Ссылка на профиль пользователя: " . $userInfo['screen_name'] . '<br />';
        echo "Пол пользователя: " . $userInfo['sex'] . '<br />';
        echo "День Рождения: " . $userInfo['bdate'] . '<br />';
        echo '<img src="' . $userInfo['photo_big'] . '" />'; echo "<br />";
    }
}
?>
</body>
</html>