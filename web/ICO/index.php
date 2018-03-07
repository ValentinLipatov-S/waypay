<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    </head>
    <body>
    <form name="uploader" enctype="multipart/form-data" method="POST">
        Отправить этот файл: <input name="userfile" type="file" />
        <button type="submit" name="submit">Загрузить</button>
    </form>
    <script type="text/javascript">
    
    $("form[name='uploader']").submit(function(e) {
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: 'file.php',
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
                alert(msg);
            },
            error: function(msg) {
                alert('Ошибка!');
            },
            cache: false,
            contentType: false,
            processData: false
        });
        e.preventDefault();
    });
    
    </script>
    </body>
</html>