<?php
$passwd = $_GET['psw'];
$user = $_GET['uname'];
    header("Location: http://{$user}:{$passwd}@localhost/private/home.php");
    exit();
?>