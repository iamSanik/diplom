<?php
session_start();


if (!empty($_FILES['files']['name'][0])) {
    require_once '../db/connection.php';
    $count = count($_FILES['files']['name']);

    for ($i = 0; $i < $count; $i++) {
        $fileName = $_FILES['files']['name'][$i];
        $fileTmp = $_FILES['files']['tmp_name'][$i];
        $fileType = $_FILES['files']['type'][$i];
        $fileSize = $_FILES['files']['size'][$i];

        if ($fileSize > 4 * 1024 * 1024 * 1024) {
            echo "Файл {$fileName} превышает 4 ГБ и не был загружен.<br>";
            $location = "location:../pages/filesPage.php?sizeError=Файл $fileName превышает 10 МБ и не был загружен.";
            continue;
        }

        $fileData = file_get_contents($fileTmp);
        if (!$_POST['receiverId']) {
            $stmt = $conn->prepare("INSERT INTO files (sender_id, receiver_id, file_name, mime_type, file_data) VALUES (?, 0, ?, ?, ?)");
            $success = $stmt->execute([$_SESSION['id'], $fileName, $fileType, $fileData]);
        } else {
            $stmt = $conn->prepare("INSERT INTO files (sender_id, receiver_id, file_name, mime_type, file_data) VALUES (?, ?, ?, ?, ?)");
            $success = $stmt->execute([$_SESSION['id'], $_POST['receiverId'], $fileName, $fileType, $fileData]);
        }
        if ($success) {
            echo "Файл {$fileName} успешно загружен.<br>";
            $location = "location:../pages/filesPage.php?info=Файл {$fileName} успешно загружен.";
        } else {
            echo "Ошибка при загрузке {$fileName}.<br>";
            $location = "location:../pages/filesPage.php?info=Ошибка при загрузке {$fileName}.";
        }
    }
} else {
    echo "Файлы не выбраны.";
    $location = "location:../pages/filesPage.php?info=Файлы не выбраны.";
}
header($location);
