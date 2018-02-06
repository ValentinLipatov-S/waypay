<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>Аутентификация через ВКонтакте</title>
</head>
<body>
    <?php

    $client_id = '6361837'; // ID приложения
    $client_secret = '9pohMcwaxBYL02WMTR3M'; // Защищённый ключ
    $redirect_uri = 'https://waypay.herokuapp.com/'; // Адрес сайта

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

    $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);

    if (isset($token['access_token'])) {
        $params = array(
            'user_ids'         => $token['user_id'],
            'fields'       => 'id,first_name,last_name,screen_name,sex,bdate,photo_big',
            'access_token' => $token['access_token'],
			'v' => '5.71',
			'name_case' => 'Nom'
        );

        $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
        print_r($userInfo);
		
		if (isset($userInfo['response'][0]['id'])) {
            $userInfo = $userInfo['response'][0];
            $result = true;
        }
    }

    if ($result) {
        echo "Социальный ID пользователя: " . $userInfo['id'] . '<br />';
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