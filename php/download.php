<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../index.html');
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Некорректный ID файла.');
}

require_once '../db/connection.php';

$fileId = intval($_GET['id']);
$userId = $_SESSION['id'];

// Получаем данные файла из БД
$stmt = $conn->prepare("
    SELECT file_name, mime_type, file_path, receiver_id, sender_id 
    FROM files 
    WHERE id = ? AND (receiver_id = ? OR receiver_id = 0)
");
$stmt->execute([$fileId, $userId]);
$file = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$file) {
    die('Файл не найден или у вас нет к нему доступа.');
}

// Формируем путь к файлу на сервере из file_path
$filePath = '../' . $file['file_path'];

if (!file_exists($filePath)) {
    die('Файл не найден на сервере.');
}

// Отправляем заголовки для скачивания файла
header('Content-Description: File Transfer');
header('Content-Type: ' . $file['mime_type']);
header('Content-Disposition: attachment; filename="' . basename($file['file_name']) . '"');
header('Content-Length: ' . filesize($filePath));
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Expires: 0');

readfile($filePath);
exit;
