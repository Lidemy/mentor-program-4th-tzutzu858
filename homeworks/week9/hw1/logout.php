<?php
require_once "conn.php";
$token = $_COOKIE['token'];
$sql = sprintf("DELETE FROM tzu_tokens WHERE token = '%s'", $token);
$conn->query($sql);
setcookie("token", "", 0);
header("Location: index.php");
