<?php
if(!empty($_POST['username']) 
    && !empty($_POST['password'])){
        require_once "../db/connection.php";
        $checkUser = $conn->prepare('select username, email, password from users where username = ? or email = ?');
        $checkUser->execute(array($_POST['username'], $_POST['email']));
        $checkUser = $checkUser->fetch();
        var_dump($checkUser['password']);
        if($_POST['password'] == $checkUser['password']){
            session_start();
            $_SESSION['id'];
        }
    }

?>