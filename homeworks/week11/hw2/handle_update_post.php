<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  require_once("check_permission.php");

  $page = $_POST['page'];

  if (
    empty($_POST['id']) ||
    empty($_POST['content']) || 
    empty($_POST['title'])
  ) {
    header('Location: ' . $page);
    die('資料不齊全');
  }

  $id = $_POST['id'];
  $content = $_POST['content'];
  $title = $_POST['title'];

  $sql = "UPDATE posts SET title=?, content=? WHERE id=?";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ssi', $title, $content, $id);
  
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }

  header("Location: " . $page);
?>
