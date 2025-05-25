<?php
$dbSetup = "mysql:host=127.0.0.1:3308;dbname=kinas;charset=utf8";
$dbUser = "kinas";
$dbPass = "L9JiJ%ABAQH4P7XS";
$dbErrMode = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
$conn = new PDO( $dbSetup, $dbUser, $dbPass, $dbErrMode);
?>