<?php

if(!empty($_FILES['fileToUpload']['tmp_name'])){
    require_once '../db/connection.php';

    $file_name = $FILES['fileToUpload']['name'];
    $file_tmp = $FILES['filetoUpload']['tmp_name'];
    $file_type = $FILES['filetoUpload']['type'];

    $file_content = file_get_contents($file_tmp);

    $stmt = $conn -> prepare("insert into files (file_name, mime_type, file_data) values (?,?,?)");
   if( $stmt ->execute(array( $file_name, $file_type, $file_content))){
    echo "Файл успешно загружен в БД";
   } else{
    echo "Ошибка при сохранении в БД";
   }


    

}


?>