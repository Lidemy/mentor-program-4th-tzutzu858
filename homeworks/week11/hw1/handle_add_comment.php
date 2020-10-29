<?php
session_start();
require_once 'conn.php';
require_once "utils.php";
if (empty($_POST['content'])) {
    die('資料不齊全');
}

$username = $_SESSION['username'];
$user = getUserFromUsername($username);

if (!hasPermission($user, 'create', null)) {
    header("Location: index.php");
    exit;
}
$content = $_POST['content'];
$sql = "INSERT INTO tzu_comments(username, content) VALUE(?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $username, $content); //兩個參數都是字串，就打SS
$result = $stmt->execute();
if (!$result) {
    die($conn->error);
}

header("Location: index.php");
