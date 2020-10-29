<?php
        if (!empty($_GET['errCode'])) {
            $code = $_GET['errCode'];
            $msg = 'Error';
            if ($code==='2') {
                $msg = '帳號已被註冊';
            }
            echo '<h3 class="error">錯誤 : ' . $msg . '</h3>';
        }

        if (strpos($conn->error,"Duplicate entry")!== false) {
            header('Location: register.php?errCode=2');
        }
        die($conn->error);


        
        if (!empty($_GET['errCode'])) {
            $code = $_GET['errCode'];
            $msg = 'Error';
            if ($code === '2') {
                $msg = '帳號密碼有誤';
            }
            echo '<h3 class="error">錯誤 : ' . $msg . '</h3>';
        }
      

?>  

