<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/script.js" defer></script>
    <title>Корпоративное хранилище</title>
</head>

<body>
    <header class="header">
        <a href="#"><img class="logo" src="../images/logo.webp" alt="Логотип компании"></a>
        <nav class="header__nav">
            <div class="header__cat">
                <a href="#" class="header__cat-link active">Главная</a>
                <a href="#" class="header__cat-link">Файлы</a>
                <a href="#" class="header__cat-link">Совместная работа</a>
                <a href="#" class="header__cat-link">Безопасность</a>
                <a href="#" class="header__cat-link">Помощь</a>
                <a href="#" class="header__cat-link">Уведомления</a>
            </div>
            <div class="header__user">
                <div class="profile-container">
                    <details id="registrationDetails">
                        <summary style="cursor: pointer;" class="sign_up" >sign in</summary>
                        <div id="registrationForm">
                            <form action="php/reg.php" method="post">
                                <label for="username">Имя пользователя:</label><br>
                                <input type="text" id="username" name="username" required><br>
                                <label for="email">Email:</label><br>
                                <input type="email" id="email" name="email" required><br>
                                <label for="password">Пароль:</label><br>
                                <input type="password" id="password" name="password" required><br>
                                <input type="submit" value="войти">
                            </form>
                        </div>
                    </details>
                </div>
            </div>
        </nav>
    </header>

    <main>

    </main>
</body>


</html>

