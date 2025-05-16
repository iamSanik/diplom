<?php
session_start();
if(!empty($_POST['status'])){
    require_once '../db/connection.php';
    $stmt = $conn -> prepare('update files set status = ?    where id = ? ');
    $stmt -> execute([$_POST['status'], $_POST['message_id']]);

    header("Location: " . $_SERVER['HTTP_REFERER']);
} else{
    echo "something went wrong";
}

?>