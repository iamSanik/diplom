<? session_start();

if ($_SESSION['role'] == 1) {
    header('location: adminPage.php');
}

if (isset($_SESSION['id'])) {
    require_once '../db/connection.php';

    // Получаем файлы, отправленные текущему пользователю или всем пользователям
    $stmt = $conn->prepare("SELECT id, sender_id, receiver_id, file_name, mime_type, upload_date, status FROM files  WHERE receiver_id = ? OR receiver_id = 0 ORDER BY upload_date DESC");
    $stmt->execute([$_SESSION['id']]);
    $files = $stmt->fetchAll();

    // Дополнительно получаем информацию об отправителях для отображения имен
    $users = [];
    $stmt = $conn->prepare("SELECT id, login FROM users");
    $stmt->execute();
    $userResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($userResults as $user) {
        $users[$user['id']] = $user['username'];
    }
} else {
    header('location:../index.html');
    exit;
}
?>

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
    <script src="../js/script.js" defer></script>
    <title>Корпоративное хранилище</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        
        .container {
            max-width: 1000px;
            margin: 200px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            text-align: center;
            color: #333;
        }
        
        .files-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .files-table th, .files-table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        
        .files-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        
        .files-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .status-new {
            background-color: #d0f0ff !important;
        }
        
        .status-read {
            background-color: #f5f5f5 !important;
        }
        
        .status-form {
            margin: 0;
            padding: 0;
            border: none;
            background: none;
            box-shadow: none;
        }
        
        .download-link {
            color: #3498db;
            text-decoration: none;
        }
        
        .download-link:hover {
            text-decoration: underline;
        }
        
        .no-files {
            text-align: center;
            padding: 20px;
            color: #777;
        }
</style>

<body>
    <header class="header">
        <a href="#"><img class="logo" src="../images/logo.webp" alt="Логотип компании"></a>
        <nav class="header__nav">
            <div class="header__cat">
                <a href="userPage.php" class="header__cat-link active">Главная</a>
                <a href="filesPage.php" class="header__cat-link">Отправка файлов</a>
                <a href="securityPage.php" class="header__cat-link">Безопасность</a>
                <a href="helpPage.php" class="header__cat-link">Помощь</a>
            </div>
            <div class="header__user">
                <div class="profile-container">
                    <svg width="64px" height="64px" viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.4800000000000001"></g>
                        <g id="SVGRepo_iconCarrier">
                            <circle cx="12" cy="9" r="3" stroke="#1C274C" stroke-width="1.416"></circle>
                            <circle cx="12" cy="12" r="10" stroke="#1C274C" stroke-width="1.416"></circle>
                            <path d="M17.9691 20C17.81 17.1085 16.9247 15 11.9999 15C7.07521 15 6.18991 17.1085 6.03076 20" stroke="#1C274C" stroke-width="1.416" stroke-linecap="round"></path>
                        </g>
                    </svg>
                    <p><? echo $_SESSION['login'] ?></p>
                    <a href="../php/logout.php">Выйти</a>
                </div>
            </div>
        </nav>
    </header>

    <main>


    <div class="container">
        <h1>Мои файлы</h1>
        
        <?php if (!empty($files)): ?>
            <table class="files-table">
                <thead>
                    <tr>
                        <th>Имя файла</th>
                        <th>Отправитель</th>
                        <th>Тип файла</th>
                        <th>Дата загрузки</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($files as $file): ?>
                        <?php $statusClass = ($file['status'] === 'новое') ? 'status-new' : 'status-read'; ?>
                        <tr class="<?= $statusClass ?>">
                            <td><?= $file['file_name'] ?></td>
                            <td>
                                <?php 
                                if ($file['sender_id'] == 0) {
                                    echo 'Системное сообщение';
                                } else {
                                    echo isset($users[$file['sender_id']]) ? 
                                        htmlspecialchars($users[$file['sender_id']]) : 
                                        'Пользователь #' . $file['sender_id'];
                                }
                                ?>
                            </td>
                            <td><?= $file['mime_type'] ?></td>
                            <td><?= $file['upload_date'] ?></td>
                            <td>
                                <? if($file['status'] === 'Новое'): ?>
                                <form method="post" action="../php/updateStatus.php" class="status-form">
                                    
                                    <select name="status" onchange="this.form.submit()">
                                        <option value="Новое" <?= $file['status'] === 'Новое' ? 'selected' : '' ?>>Новое</option>
                                        <option value="Просмотрено" <?= $file['status'] === 'Просмотрено' ? 'selected' : '' ?>>Просмотрено</option>
                                    </select>
                                    <input type="hidden" name="message_id" value="<?= $file['id'] ?>">
                                </form>
                                <?else:?>
                                    <p>Просмотрено</p>
                                <?endif?>
                            </td>
                            <td>
                                <a href="../php/download.php?id=<?= $file['id'] ?>" class="download-link">Скачать</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-files">
                <p>У вас нет доступных файлов</p>
            </div>
        <?php endif; ?>
    </div>
    
    <script>
        // Автоматическая отправка формы при изменении статуса
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelects = document.querySelectorAll('.status-form select');
            
            statusSelects.forEach(select => {
                select.addEventListener('change', function() {
                    this.closest('form').submit();
                });
            });
        });
    </script>
    </main>
</body>


</html>