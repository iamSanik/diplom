<?php
session_start();
if(!empty($_POST['username']) 
    && !empty($_POST['password'])){
        require_once "../db/connection.php";
        $checkUser = $conn->prepare('select login, email, password from users where login = ? or email = ?');
        $checkUser->execute(array($_POST['username'], $_POST['username']));
        $checkUser = $checkUser->fetch();
        var_dump($checkUser['login']);
        if($checkUser && $checkUser['password'] == $_POST['password']){
            $_SESSION['id'] = $checkUser['id'];
            $_SESSION['login'] = $checkUser['login'];
            $location = 'location:../pages/userPage.php';
        } else {
            $location = 'location:../index.php';
        }
    }

    header($location);

?>