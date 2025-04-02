<?php
if (!empty($_POST['username']) 
&& !empty($_POST['email']) 
&& !empty($_POST['password'])) {
    require_once "../db/connection.php";

    $checkUser = $conn->prepare('select username, email from users where username = ? or email = ?');
    $checkUser->execute(array($_POST['username'], $_POST['email']));
    $checkUser = $checkUser->fetch();
    var_dump($checkUser);

    if (!$checkUser) {
        $conn->prepare('insert into users (username, email, password) values (?, ?, ?)')->execute(array($_POST['username'], $_POST['email'], $_POST['password']));
    } elseif ($checkUser === $_POST['email']) {
        $location = 'location:../index.php';
    } elseif ($checkUser === $_POST['username']) {
        $location = 'location:../index.php';
    } else {
        $location = 'location:../index.php';
    };
    header($location);
}
