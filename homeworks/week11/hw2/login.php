<?php 
session_start();
require_once "conn.php";
require_once "utils.php";
?>


<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">

  <title>部落格</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="normalize.css" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
<?php include_once('header.php')?>
  <section class="banner">
    <div class="banner__wrapper">
      <h1>存放技術之地</h1>
      <div>Welcome to my blog</div>
    </div>
  </section>
  <div class="login-wrapper">
    <h2>Login</h2>
    <form action="handle_login.php" method="POST">
      <div class="input__wrapper">
        <div class="input__label">USERNAME</div>
        <input class="input__field" type="text" name="username" required/>
      </div>
      
      <div class="input__wrapper">
        <div class="input__label">PASSWORD</div>
        <input class="input__field" type="password" name="password" required/>
      </div>
      <?php
        if (!empty($_GET['errCode'])) {
            $code = $_GET['errCode'];
            $msg = 'Error';
            if ($code === '2') {
                $msg = '帳號密碼有誤';
            }
            echo '<h3 class="error">錯誤 : ' . $msg . '</h3>';
        }
      ?>
      <input type='submit' value="登入" />
    </form>
     
  </div>
</body>
</html>