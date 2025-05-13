<?php
session_start();

if (!empty($_POST['username']) 
&& !empty($_POST['email']) 
&& !empty($_POST['password'])) {
    require_once "../db/connection.php";

    $checkUser = $conn->prepare('select login, email from users where login = ? or email = ?');
    $checkUser->execute(array($_POST['username'], $_POST['email']));
    $checkUser = $checkUser->fetch();

    if ($checkUser) {
        $_SESSION['error'] = "Пользователь с таким именем или email уже существует.";
        header("location:../index.php");
        exit();
    } else {
        try {
            $stmt = $conn->prepare('insert into users (login, email, password) values (?, ?, ?)');
            $stmt->execute(array($_POST['username'], $_POST['email'], $_POST['password']));
            header('location:../pages/authPage.php'); // Перенаправление на страницу входа после успешной регистрации
            exit();
        } catch (PDOException $e) {
            $_SESSION['error'] = "Ошибка при регистрации: " . $e->getMessage();
            header("location:../index.php");
            exit();
        }
    }
}
