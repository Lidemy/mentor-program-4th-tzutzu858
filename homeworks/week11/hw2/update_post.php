<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");
  require_once("check_permission.php");

  $id = intval($_GET['id']);

  $stmt = $conn->prepare(
    'SELECT '.
      'P.id AS id, P.content AS content, P.title AS title, '.
      'P.created_at AS created_at, U.nickname AS nickname, U.username AS username '.
    'FROM posts AS P ' .
    'LEFT JOIN tzu_users AS U on P.username = U.username '.
    'WHERE P.id = ?'
  );
  $stmt->bind_param('i', $id);
  $result = $stmt->execute();
  if (!$result) {
    die('Error:' . $conn->error);
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
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
  <?php include_once('header.php') ?>
  <section class="banner">
    <div class="banner__wrapper">
      <h1>存放技術之地</h1>
      <div>Welcome to my blog</div>
    </div>
  </section>
  <div class="container-wrapper">
    <div class="container">
      <div class="edit-post">
        <form action="handle_update_post.php" method="POST">
          <div class="edit-post__title">
            編輯文章：
          </div>
          <div class="edit-post__input-wrapper">
            <input name="title" class="edit-post__input" placeholder="請輸入文章標題" value="<?php echo escape($row['title']); ?>"/>
          </div>
          <div class="edit-post__input-wrapper">
            <textarea name="content" rows="20" class="edit-post__content"><?php echo escape($row['content']); ?></textarea>
          </div>
          <div class="edit-post__btn-wrapper">
              <input type="submit" class="edit-post__btn" value="送出" />
          </div>
          <input type="hidden" name="id" value="<?php echo escape($row['id']); ?>" />
          <input type="hidden" name="page" value="<?php echo $_SERVER['HTTP_REFERER'] //$_SERVER導回上一頁 ?>" /> 
        </form>
      </div>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>