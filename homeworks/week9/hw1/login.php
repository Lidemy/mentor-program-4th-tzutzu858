<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>留言板註冊</title>
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
        登入
        </h1>
        <div class="signin_register">
            <a class="board_btn" href="index.php">回留言板</a>
            <a class="board_btn" href="register.php">註冊</a>
        </div>
    </div>
     <form  class="board_form" method="POST" action="handle_login.php">
        <?php
            if (!empty($_GET['errCode'])) {
                $code = $_GET['errCode'];
                $msg = 'Error';
                if ($code==='2') {
                    $msg = '帳號密碼有誤';
                }
            echo '<h3 class="error">錯誤 : ' . $msg . '</h3>';
        }
        ?> 
         <div class="board_input_block">
             <span>帳號 :</span>
             <input id=nickname type="text" name="username">
             <p class="input-ok">帳號沒填</p>
         </div>

         <div class="board_input_block">
             <span>密碼 :</span>
             <input id=nickname type="password" name="password">
             <p class="input-ok">密碼沒填</p>
         </div>
         <div class="textarea_bottom">
            <input class="board_submit-btn" type="submit" />
         </div>
     </form>
     <div class="board_hr"></div>
 </main>
 <script>

    document.querySelector('form').addEventListener('submit',
    (e) => {
        if (!flagSubmit()) {
            e.preventDefault();
        }
    });

    function flagSubmit() {
        const inputBlock = document.querySelectorAll('.board_input_block');
        console.log(inputBlock);
        var hasCheck = false;
        for (const inputCheck of inputBlock) {
            const errMsg = inputCheck.querySelector('p');
            const inputValue = inputCheck.querySelector('input');
            if (inputValue.value) {
                errMsg.className = 'input-ok';
                hasCheck = true;
            } else {
                errMsg.className = 'input-err';
                hasCheck = false;
            }
        }

        if (!hasCheck){
            return false
        }
     return true
    }
 </script>
</body>
</html>
