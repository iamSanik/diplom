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
    <link rel="stylesheet" href="../css/files.css">
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
                <a href="filesPage.php" class="header__cat-link">Файлы</a>
                <a href="#" class="header__cat-link">Совместная работа</a>
                <a href="#" class="header__cat-link">Безопасность</a>
                <a href="#" class="header__cat-link">Помощь</a>
                <a href="#" class="header__cat-link">Уведомления</a>
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
    <main>
        <div class="file-upload-form">
  <h2 class="form-title">Загрузить файлы</h2>
  
  <form action="../php/sendFile.php" method="post" enctype="multipart/form-data">
  <div class="file-upload-area">
    <div class="file-upload-icon">📁</div>
    <p class="file-upload-text">Перетащите файлы сюда или нажмите для выбора</p>
    <p class="file-upload-hint">Поддерживаемые форматы: JPG, PNG, PDF, DOC до 10 МБ</p>
    <input type="button" id="addFileBtn" value="Добавить файл">
    <input type="file" id="fileInput" style="display: none;">  
    <div id="fileList" style="margin-top:10px">Выбранные файлы: <ul style="width: fit-content; margin: auto;"></ul></div>
  </div>
  
  <button type="submit" class="submit-button" name="fileBttn">Загрузить файлы</button>
</div>
</form>
    </main>

    </html>
<? else: ?>

    <!DOCTYPE html>
    <html lang="ru">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <h1>только для авторизированных пользователей</h1>
    </body>

    </html>
<? endif ?>