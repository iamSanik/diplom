<? session_start();

if (!$_SESSION['role']) {
    header('location: userPage.php');
}



require_once '../db/connection.php';
$users = $conn->prepare('SELECT `id`, `login`, `email`, `password`, `role` FROM `users` WHERE id != ?');
$users->execute([$_SESSION['id']]);
$users = $users->fetchAll();



if(!empty($_GET['error'])){
    $err = $_GET['error'];
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/adminPage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
    <script src="../js/script.js" defer></script>
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
                    <div class="profile-container__info">
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
                    </div>
                    <form action="../php/logout.php" method="post" style="margin-top: 8px;">
                        <input class="profile-container__button" type="submit" value="Выйти">
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <main class="page-content">
        <div class="header__manage">
            <div class="profile-container">
                <details id="registrationDetails">
                    <summary style="cursor: pointer;" class="sign_up">добавить пользователя</summary>
                    <div id="registrationForm">
                        <form action="../php/reg.php" method="post">
                            <label for="username">Имя пользователя:</label><br>
                            <input type="text" id="username" name="username" required><br>
                            <label for="email">Email:</label><br>
                            <input type="email" id="email" name="email" required><br>
                            <label for="password">Пароль:</label><br>
                            <input type="password" id="password" name="password" required><br>
                            <p><?= $err ?></p>
                            <input type="submit" value="войти">
                        </form>
                    </div>
                </details>
            </div>
            <div style="margin-top: 30px;">
                <? foreach ($users as $user): ?>
                    <form class="users" action="../php/editUser.php" method="post">

                        <p>ID пользователя: <?= $user['id'] ?></p>
                        <p>Имя пользователя: <?= $user['login'] ?></p>
                        <p>Email пользователя: <?= $user['email'] ?></p>
                        <input style="margin-bottom: 10px;" type="text" name="changePass" placeholder="<?= $user['password']?>">
                        <input type="submit" name="changePassBtn" value="Изменить пароль">

                        <input type="hidden" name="UserId" value="<?= $user['id'] ?>">
                        <input type="submit" name="delUserBtn" value="Удалить пользователя">

                    </form>
                <?php endforeach; ?>
            </div>
        </div>

    </main>
</body>


</html>