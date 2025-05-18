<?php

if(isset($_POST['delUserId']) &&
    !empty($_POST['delUserId'])){
        require_once "../db/connection.php";

        $conn ->prepare("delete from users where id = ?")->execute([$_POST['delUserId']]);
        $location = 'location:../pages/adminPage.php';
        var_dump($_POST['delUserId']);
    }
    else{
        echo "такого пользователя не существует";
        $location = 'location:../pages/adminPage.php';
    }
    header($location);


?>