<?php


if (
    isset($_POST['changePass']) &&
    !empty($_POST['changePass']) &&
    isset($_POST['changePassBtn']) &&
    !empty($_POST['changePassBtn'])
) {
    require_once "../db/connection.php";

    $conn->prepare("update users set password = ? where id = ? and password != ?")->execute([$_POST['changePass'], $_POST['UserId'], $_POST['changePass']]);
    $location = 'location:../pages/adminPage.php';
} else {
    $location = "location:../pages/adminPage.php?editError=Что то пошло не так";
}


if (isset($_POST['delUserBtn'])) {
    if (!empty($_POST['UserId'])) {
        require_once "../db/connection.php";

        $conn->prepare("delete from users where id = ?")->execute([$_POST['UserId']]);
        $location = 'location:../pages/adminPage.php';
        var_dump($_POST['UserId']);
    } else {

        $location = 'location:../pages/adminPage.php?passError=Такого пользователя не существует';
    }
}
header($location);
