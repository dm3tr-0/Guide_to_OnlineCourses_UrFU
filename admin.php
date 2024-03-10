<?php
session_start();

// Проверка авторизации
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Обработка формы изменения текста
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['text'])) {
    file_put_contents('index.html', $_POST['text']);
}

// Обработка формы изменения стилей
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['styles'])) {
    file_put_contents('styles.css', $_POST['styles']);
}

// Обработка формы изменения скриптов
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['scripts'])) {
    file_put_contents('scripts.js', $_POST['scripts']);
}

// Обработка формы загрузки картинок
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $target_dir = 'imgs/';
    $target_file = $target_dir . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
}

// Загрузка текущего содержимого файлов
$text_content = file_get_contents('index.html');
$styles_content = file_get_contents('styles.css');
$scripts_content = file_get_contents('scripts.js');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>

<body>
    <h1>Welcome to the Admin Panel</h1>
    <form method="post">
        <label for="text">Edit Text:</label><br>
        <textarea id="text" name="text" rows="4" cols="50"><?= htmlspecialchars($text_content) ?></textarea><br>
        <input type="submit" value="Save Text">
    </form>

    <form method="post">
        <label for="styles">Edit Styles:</label><br>
        <textarea id="styles" name="styles" rows="4" cols="50"><?= htmlspecialchars($styles_content) ?></textarea><br>
        <input type="submit" value="Save Styles">
    </form>

    <form method="post">
        <label for="scripts">Edit Scripts:</label><br>
        <textarea id="scripts" name="scripts" rows="4" cols="50"><?= htmlspecialchars($scripts_content) ?></textarea><br>
        <input type="submit" value="Save Scripts">
    </form>

    <form method="post" enctype="multipart/form-data">
        <label for="image">Upload Image:</label><br>
        <input type="file" id="image" name="image" accept="image/*"><br>
        <input type="submit" value="Upload Image">
    </form>

    <a href="logout.php">Logout</a>
</body>

</html>
