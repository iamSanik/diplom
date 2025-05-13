<?php
session_start();

if(isset($_SESSION['login']) &&
 !empty($_SESSION['login']) &&
 isset($_SESSION['id']) &&
 !empty($_SESSION['id'])):
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<?else:?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <h1>только для зарегистрированных пользователей</h1>
    </body>
    </html>
<?endif?>