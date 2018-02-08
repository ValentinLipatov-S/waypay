
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
                    <div style="width: 75px; height: 75px; background: url('<? echo $_SESSION['user_info']['photo_big']?>'); background-size: cover; border-radius: 50%;"></div>
                        <div style="flex: 1 1; padding: 0px 0px 0px 10px;">
                            <div>
                                <text class="name" style="display: flex;"><? echo $_SESSION['user_info']['first_name']?>&nbsp;<? echo $_SESSION['user_info']['last_name']?></text>
                                <text style="display: flex; font-size: 11px;"><? echo $_SESSION['user_info']['id']?></text>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!--<div class="main loadingbar">
           
            <input type="submit" class="text" value="РёСЃС‚РѕСЂРёСЏ РѕРїРµСЂР°С†РёР№" style = "background: white;"/>
        </div>-->
        <div class="flex_container_row_stretch">
            <input style = "flex: 1 1;" type="text" class="text" placeholder="РЎСѓРјРјР°" />
            <input style = "flex: 1 1;" type="submit" class="text" value="РџРѕРїР»РЅРёС‚СЊ" />
            <input style = "flex: 1 1;" type="submit" class="text" value="РЎРЅСЏС‚СЊ" />
        </div>
        <div class="main loadingbar">
            <input type="text" class="text" placeholder="РџРѕРёСЃРє" />
        </div>
        <div class="container">



            <div class="user_container flex_container_row_stretch">

                <div style="width: 50px; height: 50px; background: url(2.png); ; background-size: cover; border-radius: 50%;"></div>

                <div style="flex: 1 1; padding: 0px 0px 0px 10px;">
                    <div>
                        <text class="name" style="display: flex;">Р›РёРїР°С‚РѕРІ Р’Р°Р»РµРЅС‚РёРЅ</text>
                        <text style="display: flex; font-size: 11px;">123456789</text>
                    </div>
                </div>
            </div>


            <div class="user_container flex_container_row_stretch">

                <div style="width: 50px; height: 50px; background: url(2.png); ; background-size: cover; border-radius: 50%;"></div>

                <div style="flex: 1 1; padding: 0px 0px 0px 10px;">
                    <div>
                        <text class="name" style="display: flex;">Р›РёРїР°С‚РѕРІ Р’Р°Р»РµРЅС‚РёРЅ</text>
                        <text style="display: flex; font-size: 11px;">123456789</text>
                    </div>
                </div>
            </div>
            
            
            
            <div class="user_container flex_container_row_stretch">

                <div style="width: 50px; height: 50px; background: url(2.png); ; background-size: cover; border-radius: 50%;"></div>

                <div style="flex: 1 1; padding: 0px 0px 0px 10px;">
                    <div>
                        <text class="name" style="display: flex;">Р›РёРїР°С‚РѕРІ Р’Р°Р»РµРЅС‚РёРЅ</text>
                        <text style="display: flex; font-size: 11px;">123456789</text>
                    </div>
                </div>
            </div>
            
            
            
            
            <div class="user_container flex_container_row_stretch">

                <div style="width: 50px; height: 50px; background: url(2.png); ; background-size: cover; border-radius: 50%;"></div>

                <div style="flex: 1 1; padding: 0px 0px 0px 10px;">
                    <div>
                        <text class="name" style="display: flex;">Р›РёРїР°С‚РѕРІ Р’Р°Р»РµРЅС‚РёРЅ</text>
                        <text style="display: flex; font-size: 11px;">123456789</text>
                    </div>
                </div>
            </div>
            
            
            
            
            <div class="user_container flex_container_row_stretch">

                <div style="width: 50px; height: 50px; background: url(2.png); ; background-size: cover; border-radius: 50%;"></div>

                <div style="flex: 1 1; padding: 0px 0px 0px 10px;">
                    <div>
                        <text class="name" style="display: flex;">Р›РёРїР°С‚РѕРІ Р’Р°Р»РµРЅС‚РёРЅ</text>
                        <text style="display: flex; font-size: 11px;">123456789</text>
                    </div>
                </div>
            </div>
            
            
            
            <div class="user_container flex_container_row_stretch">

                <div style="width: 50px; height: 50px; background: url(2.png); ; background-size: cover; border-radius: 50%;"></div>

                <div style="flex: 1 1; padding: 0px 0px 0px 10px;">
                    <div>
                        <text class="name" style="display: flex;">Р›РёРїР°С‚РѕРІ Р’Р°Р»РµРЅС‚РёРЅ</text>
                        <text style="display: flex; font-size: 11px;">123456789</text>
                    </div>
                </div>
            </div>
            
            
            
            
            <div class="user_container flex_container_row_stretch">

                <div style="width: 50px; height: 50px; background: url(2.png); ; background-size: cover; border-radius: 50%;"></div>

                <div style="flex: 1 1; padding: 0px 0px 0px 10px;">
                    <div>
                        <text class="name" style="display: flex;">Р›РёРїР°С‚РѕРІ Р’Р°Р»РµРЅС‚РёРЅ</text>
                        <text style="display: flex; font-size: 11px;">123456789</text>
                    </div>
                </div>
            </div>
            
            
            
            <div class="user_container flex_container_row_stretch">

                <div style="width: 50px; height: 50px; background: url(2.png); ; background-size: cover; border-radius: 50%;"></div>

                <div style="flex: 1 1; padding: 0px 0px 0px 10px;">
                    <div>
                        <text class="name" style="display: flex;">Р›РёРїР°С‚РѕРІ Р’Р°Р»РµРЅС‚РёРЅ</text>
                        <text style="display: flex; font-size: 11px;">123456789</text>
                    </div>
                </div>
            </div>
        </div>
        <div class="loadingbar lodingblock"></div>
    </div>
</body>

</html>