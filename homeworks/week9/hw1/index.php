<?php
require_once "conn.php";
require_once "utils.php";
$username = null;
if (!empty($_COOKIE['token'])) {
    $user = getUserFromToken($_COOKIE['token']);
    $username = $user['username'];
}

$result = $conn->query("SELECT * FROM tzu_comments ORDER BY id DESC");
if (!$result) {
    die('Error:' . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>留言板</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">

  <link rel="stylesheet" href="style.css">

</head>

<body>
 <header class="warning">
     <strong>
         注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。
    </strong>
 </header>
 <main class="board">
     <div class="board_nav">
        <h1 class="board_title">
         Comments
        </h1>

        <div class="signin_register">
        <?php if (!$username) {?>
            <a class="board_btn" href="register.php">註冊</a>
            <a class="board_btn" href="login.php">登入</a>
            <?php } else {?>
            <a class="board_btn" href="logout.php">登出</a>
            <?php }
?>
        </div>

    </div>
     <h3 class="hello">你好，<?php echo $username ?></h3>
     <form  class="board_form" method="POST" action="handle_add_comment.php">

         <textarea class="board_text" name="content" rows="5"></textarea>
         <div class="textarea_bottom">
         <?php if ($username) {?>
            <input class="board_submit-btn" type="submit" />
            <p class="input-ok">留言文字沒填</p>
            <?php } else {?>
                <h3>請登入發布留言</h3>
            <?php }?>
         </div>
     </form>

     <div class="board_hr"></div>
     <section>
        <?php
while ($row = $result->fetch_assoc()) {
    ?>
        <div class="card">

            <div class="card_avartar"></div>
            <div class="card_body">
                <div class="card_info">
                    <div class="card_author">
                        <?php echo $row['nickname']; ?>
                    </div>
                    <span class="card_time">
                        <?php echo $row['created_at'] ?>
                    </span>
                </div>
                <p class="card_content"><?php echo $row['content'] ?></p>
            </div>
         </div>
        <?php }?>
     </section>
 </main>
 <script>

    document.querySelector('form').addEventListener('submit',
    (e) => {
        if (!flagSubmit()) {
            e.preventDefault();
        }
    });

    function flagSubmit() {
        const boardText = document.querySelector('.board_text').value;
        document.querySelector('.textarea_bottom p').className = 'input-ok';
        var hasCheck = true;

        if (!boardText) {
            document.querySelector('.textarea_bottom p').className = 'input-err';
            hasCheck = false
        }

        if (!hasCheck){
            return false;
        }
        return true;
    }
 </script>
</body>
</html>
