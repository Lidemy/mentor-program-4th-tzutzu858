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

$page = 1;
if (!empty($_GET['page'])) {
    $page = intval($_GET['page']);
}
$items_per_page = 5;
$offset = ($page - 1) * $items_per_page;

$stmt = $conn->prepare(
    'SELECT ' .
    'C.id AS id, C.content AS content, ' .
    'C.created_at AS created_at, U.nickname AS nickname, U.username AS username ' .
    'FROM tzu_comments AS C ' .
    'LEFT JOIN tzu_users AS U on C.username = U.username ' .
    'WHERE C.is_deleted IS NULL ' .
    'ORDER BY C.id DESC ' .
    'LIMIT ? OFFSET ?'
);
$stmt->bind_param('ii', $items_per_page, $offset);
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

  <title>留言板</title>
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
 <main class="board">
    <div class="board_nav">
        <h1 class="board_title">
         Comments
        </h1>

        <div class="signin_register">
        <?php if ($user && $user['role'] === 'ADMIN') {?>
            <a class="board_btn" href="admin.php">管理後臺</a>
        <?php }?>
        <?php if (!$username) {?>
            <a class="board_btn" href="register.php">註冊</a>
            <a class="board_btn" href="login.php">登入</a>
            <?php } else {?>
            <a class="board_btn" href="logout.php">登出</a>
            <?php }?>
        </div>
    </div>

    <h3 class="hello">你好，
        <?php if (isset($user['nickname'])) {echo $user['nickname'];}?></h3>

    <span class="board_btn" id = "changeNicknameBtn">編輯暱稱</span>
    <div class="username_block hide">
        <span>新的暱稱：</span>
        <form class="nickname_form" method="POST" action="update_user.php">
           <input class="change_nickname" type="text" name="nickname" />
           <input class="board_submit-btn nickname-btn" type="submit" />
           <p class="input-ok">暱稱文字沒填</p>
        </form>
    </div>

    <form  class="board_form" method="POST" action="handle_add_comment.php">
         <textarea class="board_text" name="content" rows="5"></textarea>
         <div class="textarea_bottom">
            <?php if ($username && !hasPermission($user, 'create', null)) {?>
                <h3>你已被停權</h3>
            <?php } else if ($username) {?>
                <input class="board_submit-btn" type="submit" />
                <p class="input-ok">留言文字沒填</p>
            <?php } else {?>
                <h3>請登入發布留言</h3>
            <?php }?>
         </div>
     </form>
     <section>
<?php
while ($row = $result->fetch_assoc()) {
    ?>
        <div class="message-card">

            <div class="card_avartar"></div>
            <div class="card_body">
                <div class="card_info">
                    <div class="card_author">
                        <?php echo escape($row['nickname']); ?>
                        (@<?php echo escape($row['username']); ?>)
                    </div>
                    <span class="card_time">
                        <?php echo escape($row['created_at']); ?>
                    </span>
                    <?php if (hasPermission($user, 'modify', $row)) {?>
                        <!-- <a href="handle_update_comment.php?id=<?php echo $row['id'] ?>" class="btn_a" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">編輯</a> -->
                        <a href="update_comment.php?id=<?php echo $row['id'] ?>">編輯</a>
                        <a href="delete_comment.php?id=<?php echo $row['id'] ?>" class="btn_a">刪除</a>
                    <?php }?>

                </div>
                <p class="card_content"><?php echo escape($row['content']); ?></p>
            </div>
         </div>
        <!--  ==========加入 bootstrap 的 modal ================-->
        <!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">編輯留言</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="handle_update_comment.php">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Message:</label>
                                <textarea class="form-control" id="message-text" name="content" rows="5"><?php echo escape($row['content']) ?></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                <input type="hidden" name="id" value="<?php echo $row2['id'] ?>" />
                                <button type="submit" class="btn btn-primary">更新留言</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div> -->
        <?php }?>

     </section>
     <div class="board__hr"></div>
      <?php
$stmt = $conn->prepare(
    'SELECT count(id) AS count FROM tzu_comments WHERE is_deleted IS NULL'
);
$result = $stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$count = $row['count'];
$total_page = ceil($count / $items_per_page);
?>
      <div class="page-info">
        <span>總共有 <?php echo $count ?> 筆留言，頁數：</span>
        <span><?php echo $page ?> / <?php echo $total_page ?></span>
      </div>
      <div class="paginator">
        <?php if ($page != 1) {?>
          <a href="index.php?page=1">首頁</a>
          <a href="index.php?page=<?php echo $page - 1 ?>">上一頁</a>
        <?php }?>
        <?php if ($page != $total_page) {?>
          <a href="index.php?page=<?php echo $page + 1 ?>">下一頁</a>
          <a href="index.php?page=<?php echo $total_page ?>">最後一頁</a>
        <?php }?>

      </div>
 </main>
 <script>
    document.getElementById("changeNicknameBtn").onclick = function() {
        var form = document.querySelector('.username_block')
        form.classList.toggle('hide')
    };

    document.querySelector('.nickname_form').addEventListener('submit',
    (e) => {
        if (!nicknameSubmit()) {
            e.preventDefault();
        }
    });

    document.querySelector('.board_form').addEventListener('submit',
    (e) => {
        if (!boardSubmit()) {
            e.preventDefault();
        }
    });

    function nicknameSubmit() {
        const nicknameText = document.querySelector('.change_nickname').value;
        document.querySelector('.nickname_form p').className = 'input-ok';
        if (!nicknameText) {
            document.querySelector('.nickname_form p').className = 'input-err';
            return false;
        }
        return true;
    }

    function boardSubmit() {
        const boardText = document.querySelector('.board_text').value;
        document.querySelector('.textarea_bottom p').className = 'input-ok';
        if (!boardText) {
            document.querySelector('.textarea_bottom p').className = 'input-err';
            return false;
        }
        return true;
    }

 </script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
