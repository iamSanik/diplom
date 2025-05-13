<? session_start(); 
var_dump($_SESSION['role']);
if($_SESSION['role'] == 1){
    header('location: adminPage.php');
}

?>
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
                <svg width="64px" height="64px" viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.4800000000000001"></g><g id="SVGRepo_iconCarrier"> <circle cx="12" cy="9" r="3" stroke="#1C274C" stroke-width="1.416"></circle> <circle cx="12" cy="12" r="10" stroke="#1C274C" stroke-width="1.416"></circle> <path d="M17.9691 20C17.81 17.1085 16.9247 15 11.9999 15C7.07521 15 6.18991 17.1085 6.03076 20" stroke="#1C274C" stroke-width="1.416" stroke-linecap="round"></path> </g></svg>
                    <p><? echo $_SESSION['login'] ?></p>
                    <a href="../php/logout.php">Выйти</a>
                </div>
            </div>
        </nav>
    </header>

    <main>

    </main>
</body>


</html>