<?php
session_start();
if (
    !empty($_POST['username'])
    && !empty($_POST['password'])
) {
    require_once "../db/connection.php";
    $checkUser = $conn->prepare('select * from users where login = ? or email = ?');
    $checkUser->execute(array($_POST['username'], $_POST['username']));
    $checkUser = $checkUser->fetch();
    if ($checkUser) {
        if ($checkUser['password'] == $_POST['password']) {
            $_SESSION['id'] = $checkUser['id'];
            $_SESSION['login'] = $checkUser['login'];
            $_SESSION['role'] = $checkUser['role'];
            $location = 'location:../pages/userPage.php';
        } else {
            $location = 'location:../index.php?authError=Неверный пароль';
        }
    } else {
        $location = "location:../index.php?authError=Логин или email не совпадают";
    }
}

header($location);
