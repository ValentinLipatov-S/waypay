<?php 
if (!isset($_SESSION['user_info']))
{
    $client_id = '6361837'; // ID приложения
    $client_secret = '9pohMcwaxBYL02WMTR3M'; // Защищённый ключ
    $redirect_uri = 'https://waypay.herokuapp.com/'; // Адрес сайта

    $url = 'http://oauth.vk.com/authorize';

    $params = array(
    'client_id'     => $client_id,
    'redirect_uri'  => $redirect_uri,
    'response_type' => 'code'
    );

    header("Location: " . $url . '?' . urldecode(http_build_query($params)));
    if (isset($_GET['code'])) {
        
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
            'fields'       => 'id,first_name,last_name,screen_name,sex,bdate,photo_big',
            'access_token' => $token['access_token'],
            'v' => '5.71',
            'name_case' => 'Nom'
        );

        $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
        print_r($userInfo);

        if (isset($userInfo['response'][0]['id'])) {
            $userInfo = $userInfo['response'][0];

            session_start();
            $_SESSION['user_info'] = $userInfo;
        }
    }
}
else 
{
    if(isset($_POST['logout']))
    {
        unset($_SESSION['user_info']);
        session_destroy();
    }
}
?>