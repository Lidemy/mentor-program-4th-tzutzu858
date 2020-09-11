## 資料庫欄位型態 VARCHAR 跟 TEXT 的差別是什麼

資料庫欄位型態有分成 :

-  INT 整數型態
-  FLOAT 浮點型態
-  TEXT/CHAR/BLOB 文字型態

列出 char 和 text 結尾的文字型態 
有 var 前綴的，表示是實際存儲空間是變長的

|  型態   | 用途  | 大小  |
|  ----  | ----  | ----  |
| CHAR  | 定長字串 | 0-255位元組 |
| VARCHAR  | 變長字串 | 0-65535 位元組 |
|   |   |   |
| TINYTEXT | 短文字字串 | 0-255位元組 |
| TEXT  | 長文字資料 | 0-65 535位元組 |
| MEDIUMTEXT | 中等長度文字資料 | 0-16 777 215位元組 |
| LONGTEXT  | 極大文字資料 | 0-4 294 967 295位元組 |


**VARCHAR 跟 TEXT 的差別是什麼 :**
1. VARCHAR 可以給預設值；TEXT沒辦法給預設值
2. VARCHAR 建索引可不指定索引長度，但 TEXT 一定要指定長度
3. 如果存儲的數據大於64K，就必須使用到 MEDIUMTEXT , LONGTEXT


## Cookie 是什麼？在 HTTP 這一層要怎麼設定 Cookie，瀏覽器又是怎麼把 Cookie 帶去 Server 的？

### Cookie 是什麼？
Cookie 是一個小小的檔案，儲存在使用者端的電腦上，用來紀錄使用者的資訊用的小檔案。Cookie 的儲存每個瀏覽器不一樣，也就是說當你用 FireFox 儲存了一個網站的 Cookie，在 IE 瀏覽器上是沒辦法讀取的，無法跨瀏覽器讀取，並且 Cookie 也有時效性。

### 在 HTTP 這一層要怎麼設定 Cookie，瀏覽器又是怎麼把 Cookie 帶去 Server 的？
因為 HTTP 有健忘特性，所以要設置 Cookie 來記錄 HTTP 狀態。當使用者發 Request 時， Server 會在 Response Header帶上 setcookie 叫瀏覽器要存 Cookie，那下次發 Request 時，瀏覽器會自動把符合條件的 Cookie 帶上來，符合條件的 Cookie 是指沒有過期且 domain 要符合，然後放在 Request Header 帶去 Server 那。

實作部分就是會用到 [setcookie](http://php.net/manual/en/function.setcookie.php) 和 [$_COOKIE](http://php.net/manual/en/reserved.variables.cookies.php)

使用 `setcookie` 就是 Server 要叫瀏覽器要存 Cookie
 setcookie 通常會用到的三個參數 : 名稱、值、過期時間，如果過期時間沒設會很快就過期
舉例 :
```
setcookie ( $name, $value, $expire)
$name = "username";
$value = $_POST['username'];
$expire = time() + 3600 * 24 * 30;
```
使用 `$_COOKIE` 就是 Server 要拿瀏覽器他帶上來的 Cookie ，拿到 value 後就可以做一些事情了。


## 我們本週實作的留言板，你能夠想到什麼潛在的問題嗎？
因為還沒交這週作業，直接先看十一週，因此知道明文密碼放資料庫會有風險，或是 XSS ，使用者在可以輸入的地方放代碼，像是JavaScript、Java、VBScript、ActiveX、Flash、HTML 執行一些壞事，或是 SQL Injection，和 XSS 很像，就是在可以輸入的地方執行 SQL 指令做一些壞事，其他想很久想不太到，但總覺得一定有。

