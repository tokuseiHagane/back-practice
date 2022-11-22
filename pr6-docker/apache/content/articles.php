<?php
require "session.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Прака 5 "статьи" redis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">
</head>
<body>
<h1>Список статей</h1>
<ol>
    <?php
    $mysqli = new mysqli("db", "root", "example", "appDB");
    $result = $mysqli->query("SELECT * FROM articles");
    foreach ($result as $row) {
        echo "<li>{$row['author']} '{$row['title']}' </li>";
    }
    ?>
</ol>
<a href="index.html">На главную</a>
<br>
<a href="admin/admin.php">Админам сюда</a>
</body>
</html>