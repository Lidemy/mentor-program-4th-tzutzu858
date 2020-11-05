<?php
require_once "conn.php";

function generateToken()
{
    $s = '';
    for ($i = 1; $i <= 16; $i++) {
        $s .= chr(rand(65, 90));
    }
    return $s;
}

function getUserFromUsername($username)
{
    global $conn;
    $sql = "SELECT * FROM tzu_users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $result = $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row; // username, id, nickname, role
}

function escape($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

// $action : update, delete, crearte
function hasPermission($user, $action, $comment) {
   // print_r($comment["username"]);
    if ($user == null) {
        return;
    }
    //  如果我沒加上面 if ($user == null) 判斷式，會出現 Trying to access array offset on value of type null in ...，
    //  同學有在 slack 發問相同問題，不過看不太懂同學最後的解決辦法就是了。

    if ($user["role"] === "ADMIN") {
        return true;
    }

    if ($user["role"] === "NORMAL") {
        if ($action === 'create') {
            return true;
        }
        return ($comment["username"] === $user["username"]);
    }

    if ($user["role"] === "BANNED") {
        if ($action === 'create') {
            return $action !=='create'; // 想問為什麼不直接 return false 就好，
        }
        return ($comment["username"] === $user["username"]);
    }
    
}

function isAdmin($user)
{
    return ($user["role"] === 'ADMIN');
}
