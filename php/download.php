<?php
session_start();
if (isset($_SESSION['id']) && isset($_GET['id'])) {
    require_once '../db/connection.php';
    
    $fileId = $_GET['id'];
    
    // Проверяем, имеет ли пользователь доступ к этому файлу
    $stmt = $conn->prepare("SELECT file_name, mime_type, file_data FROM files WHERE id = ? AND (receiver_id = ? OR receiver_id = 0)");
    $stmt->execute([$fileId, $_SESSION['id']]);
    $file = $stmt->fetch();
    
    if ($file) {
        // Обновляем статус на "просмотрено"
        $updateStmt = $conn->prepare("UPDATE files SET status = 'просмотрено' WHERE id = ?");
        $updateStmt->execute([$fileId]);
        
        // Отправляем файл пользователю для скачивания
        header('Content-Type: ' . $file['mime_type']);
        header('Content-Disposition: attachment; filename="' . $file['file_name'] . '"');
        header('Content-Length: ' . strlen($file['file_data']));
        echo $file['file_data'];
        exit;
    } else {
        // Если файл не найден или пользователь не имеет к нему доступа
        header('HTTP/1.0 403 Forbidden');
        echo "Доступ запрещен";
    }
} else {
    header('location:../index.html');
}