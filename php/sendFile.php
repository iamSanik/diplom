<?php
session_start();

if (!empty($_FILES['files']['name'][0])) {
    require_once '../db/connection.php';

    $count = count($_FILES['files']['name']);
    $senderId = $_SESSION['id'];

    // Папка пользователя
    $uploadDir = "../uploads/user_$senderId/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    for ($i = 0; $i < $count; $i++) {
        $fileName = basename($_FILES['files']['name'][$i]);
        $fileTmp = $_FILES['files']['tmp_name'][$i];
        $fileType = $_FILES['files']['type'][$i];
        $fileSize = $_FILES['files']['size'][$i];

        if ($fileSize > 10 * 1024 * 1024) {
            // Ошибка: файл больше 10 МБ
            $location = "location:../pages/filesPage.php?sizeError=Файл $fileName превышает 10 МБ и не был загружен.";
            continue;
        }

        $safeName = time() . '_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $fileName);
        $filePath = $uploadDir . $safeName;

        if (move_uploaded_file($fileTmp, $filePath)) {
            // Убираем "../" из пути для БД
            $relativePath = ltrim(str_replace('../', '', $filePath), '/');
            if(!empty($_POST['receiverId'])){
            $stmt = $conn->prepare("INSERT INTO files (sender_id, receiver_id, file_name, mime_type, file_path) VALUES (?, ?, ?, ?, ?)");
            $success = $stmt->execute([$senderId, $_POST['receiverId'], $fileName, $fileType, $relativePath]);
        } else{
                $stmt = $conn->prepare("INSERT INTO files (sender_id, receiver_id, file_name, mime_type, file_path) VALUES (?, 0, ?, ?, ?)");
                $success = $stmt->execute([$senderId, $fileName, $fileType, $relativePath]);

            }
            if ($success) {
                $location = "location:../pages/filesPage.php?info=Файл $fileName успешно загружен.";
            } else {
                $location = "location:../pages/filesPage.php?info=Ошибка при записи файла $fileName в базу.";
            }
        } else {
            $location = "location:../pages/filesPage.php?info=Ошибка при перемещении файла $fileName.";
        }
    }
} else {
    $location = "location:../pages/filesPage.php?info=Файлы не выбраны.";
}

header($location);
exit;
?>