<?php
session_start();
require_once "conn.php";
require_once "utils.php";
$username = null;
$user = null;
if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username);
}

if ($user === null || $user['role'] !== 'ADMIN') {
    header('location:index.php');
    exit;
}

$stmt = $conn->prepare('SELECT id, role, nickname, username FROM tzu_users ORDER BY id ASC');
$result = $stmt->execute();
if (!$result) {
    die('Error:' . $conn->error);
}
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>後台管理</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">

  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
 <header class="warning">
     <strong>
         注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。
    </strong>
 </header>
 <main class="admin_board">
    <section class="admin_section">
        <div class="container">
            <div class="row order_list_title">
                <div class="col">id</div>
                <div class="col">role</div>
                <div class="col">nickname</div>
                <div class="col">username</div>
                <div class="col-4">調整身份</div>
            </div>
            <?php
                while ($row = $result->fetch_assoc()) {
            ?>
                <div class="row order_list">
                    <div class="col order_list_col"><?php echo escape($row['nickname']); ?></div>
                    <div class="col order_list_col role_color"><?php echo escape($row['role']); ?></div>
                    <div class="col order_list_col"><?php echo escape($row['nickname']); ?></div>
                    <div class="col order_list_col"><?php echo escape($row['username']); ?></div>
                    <div class="col-4 order_list_col">
                        <a href="handle_update_role.php?role=ADMIN&id=<?php echo escape($row['id']); ?>">管理員</a>
                        <a href="handle_update_role.php?role=NORMAL&id=<?php echo escape($row['id']); ?>">一般使用者</a>
                        <a href="handle_update_role.php?role=BANNED&id=<?php echo escape($row['id']); ?>">停權者</a>
                    </div>
                </div>
            <?php }?>
        </div>
        
    </section>
    <a class="return_btn" href="index.php">返回</a>
</main>
 <script>
     const roles = document.querySelectorAll('.role_color');
     for (const role of roles) {
        if (role.innerHTML==='ADMIN') {
            role.style.color = 'blue';
        }

        if (role.innerHTML==='NORMAL') {
            role.style.color = '#a0a0a0';
        }

        if (role.innerHTML==='BANNED') {
            role.style.color = 'red';
        }
        
     }

 </script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
