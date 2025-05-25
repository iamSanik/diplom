<?php
session_start();
if (
    isset($_SESSION['login']) &&
    !empty($_SESSION['login']) &&
    isset($_SESSION['id']) &&
    !empty($_SESSION['id'])
):
?>

<!DOCTYPE html>
    <html lang="ru">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        
        <link rel="stylesheet" href="../css/helpPage.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
        <script src="../js/script.js" defer></script>
        <script src="../js/files.js" defer></script>
        <title>Корпоративное хранилище</title>
    </head>

    <body>
        <header class="header">
        <a href="#"><img class="logo" src="../images/logo.webp" alt="Логотип компании"></a>
        <nav class="header__nav">
            <div class="header__cat">
                <a href="userPage.php" class="header__cat-link active">Главная</a>
                <a href="filesPage.php" class="header__cat-link">Отправка файлов</a>
                <a href="helpPage.php" class="header__cat-link">Помощь</a>

            </div>
            <div class="header__user">
                <div class="profile-container">
                    <svg width="64px" height="64px" viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.4800000000000001"></g>
                        <g id="SVGRepo_iconCarrier">
                            <circle cx="12" cy="9" r="3" stroke="#1C274C" stroke-width="1.416"></circle>
                            <circle cx="12" cy="12" r="10" stroke="#1C274C" stroke-width="1.416"></circle>
                            <path d="M17.9691 20C17.81 17.1085 16.9247 15 11.9999 15C7.07521 15 6.18991 17.1085 6.03076 20" stroke="#1C274C" stroke-width="1.416" stroke-linecap="round"></path>
                        </g>
                    </svg>
                    <p><? echo $_SESSION['login'] ?></p>
                    <a href="../php/logout.php">Выйти</a>
                </div>
            </div>
        </nav>
    </header>


    <div class="instruction">
    <h1>Инструкция по использованию системы корпоративного хранилища</h1>

    <h2>1. Страница авторизации (index.php)</h2>
    <p>
        Это начальная страница, с которой начинается работа пользователя в системе.
    </p>
    <ul>
        <li>Здесь вы вводите логин и пароль.</li>
        <li>При неправильных данных отображается сообщение об ошибке авторизации.</li>
        <li>После успешного входа вы попадаете на <strong>главную страницу пользователя</strong>.</li>
    </ul>

    <h2>2. Главная страница пользователя (userPage.php)</h2>
    <p>
        Это основная страница после входа в систему. Содержит следующие элементы:
    </p>
    <ul>
        <li>Шапка с навигацией и кнопкой "Выйти".</li>
        <li>Навигация по разделам: "Главная", "Отправка файлов", "Помощь".</li>
        <li>Отображается ваш логин и аватар.</li>
    </ul>

    <h2>3. Страница отправки файлов (filesPage.php)</h2>
    <p>
        Здесь реализована вся логика по загрузке и отправке файлов другим пользователям.
    </p>
    <ul>
        <li>Вы можете выбрать один или несколько файлов (JPG, PNG, PDF, DOC) размером до 10 МБ.</li>
        <li>Можно перетащить файлы мышью или выбрать вручную.</li>
        <li>Выводятся все пользователи, кроме текущего. У каждого — кнопка "Выбрать".</li>
        <li>При выборе пользователя отображается его ID, и он становится получателем файлов.</li>
        <li><strong style="color: darkred;">Если вы не выберете конкретного пользователя, файлы будут отправлены <u>всем пользователям</u>.</strong></li>
        <li>После выбора можно нажать "Загрузить файлы".</li>
        <li>Также отображаются ошибки (например, слишком большой файл) и сообщения об успешной загрузке.</li>
    </ul>

    <h2>Итог</h2>
    <p>
        Все страницы связаны между собой через систему сессий. После авторизации вы получаете доступ ко всем возможностям: загрузке, отправке и навигации.
        Интерфейс интуитивно понятный, а вся логика направлена на упрощённую работу внутри организации.
    </p>
</div>
</body>
</html>


<?php else:
    header('location:../index.php');
endif;?>