<?php

if(!empty($_GET['authError'])){
    $authErr = $_GET['authError'];
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/regPage.css">
    <title>Авторизация</title>
    
</head>

<body>
    <div class="authorization-form">
        <h2 class="form-title">Авторизация</h2>
        <form method="post" action="php/auth.php">
            <div class="form-group">
                <label for="username" class="form-label">Имя пользователя</label>
                <input type="text" id="username" name="username" class="form-input" placeholder="Введите имя пользователя" required>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" id="password" name="password" class="form-input" placeholder="Введите пароль" required>
            </div>
            <p><?= $authErr?></p>

            <button type="submit" class="form-button">Войти</button>
        </form>
    </div>
</body>

</html>