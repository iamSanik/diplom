<?php
session_start();
if(!empty($_POST['username']) 
    && !empty($_POST['password'])){
        require_once "../db/connection.php";
        $checkUser = $conn->prepare('select login, email, role, password from users where login = ? or email = ?');
        $checkUser->execute(array($_POST['username'], $_POST['username']));
        $checkUser = $checkUser->fetch();
        if($checkUser && $checkUser['password'] == $_POST['password']){
            $_SESSION['id'] = $checkUser['id'];
            $_SESSION['login'] = $checkUser['login'];
            $_SESSION['role'] = $checkUser['role'];
            $location = 'location:../pages/userPage.php';
        } else {
            $location = 'location:../index.php';
        }
    }

    header($location);

?>