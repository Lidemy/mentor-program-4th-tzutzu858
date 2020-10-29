<?php
session_start();
require_once 'conn.php';
require_once "utils.php";
if (empty($_POST['nickname'])) {
    die('資料不齊全');
}

$username = $_SESSION['username'];
$nickname = $_POST['nickname'];

$content = $_POST['content'];
$sql = "UPDATE tzu_users SET nickname=? WHERE username=?" ;
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $nickname, $username);
$result = $stmt->execute();
if (!$result) {
    die($conn->error);
}

header("Location: index.php");
