<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e6f2ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .authorization-form {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 255, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 400px;
        }

        .form-title {
            text-align: center;
            color: #1e40af;
            margin-bottom: 30px;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #1e40af;
            font-weight: bold;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            border: 2px solid #93c5fd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .form-button {
            width: 100%;
            padding: 12px;
            background-color: #1e40af;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-button:hover {
            background-color: #2563eb;
        }
    </style>
</head>

<body>
    <div class="authorization-form">
        <h2 class="form-title">Авторизация</h2>
        <form method="post" action="php/auth.php">
            <div class="form-group">
                <label for="username" class="form-label">Имя пользователя</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    class="form-input"
                    placeholder="Введите имя пользователя"
                    required>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Пароль</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-input"
                    placeholder="Введите пароль"
                    required>
            </div>

            <button type="submit" class="form-button">Войти</button>
        </form>
    </div>
</body>

</html>