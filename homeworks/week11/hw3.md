## 請說明雜湊跟加密的差別在哪裡，為什麼密碼要雜湊過後才存入資料庫
### 加密（Encrypt） :
可以再分成對稱加密 VS 非對稱加密
#### 對稱加密 : 
AES（Advanced Encryption Standard），加密解密都是用同一個 key
以凱薩加密法來說，他加密的方式就是把每個英文字母加上一個偏移量 a -> t 之類的
所以只要知道 key 的人就可以 t -> a

#### 非對稱加密 : 
![](https://i1.kknews.cc/SIG=2f87sda/34s000qq3qnps143n08.jpg)
圖為 RSA公開密鑰算法的發明人,從左到右 Ron Rivest, Adi Shamir, Leonard Adleman.
RSA 就是他們三人姓氏開頭字母拼在一起組成的。

#### 對稱加密 VS 非對稱加密舉例 :

小明和小美傳紙條傳一傳在一起後，熱戀中的情侶總是有說不完的情話，但情話總是噁心巴拉被別人看到就不好了，於是小明用了一個精美盒子，盒子上面有密碼鎖，就是那種鎖行李箱或腳踏車的那種鎖。
![](https://github.com/tzutzu858/ChallengeDailyUI/blob/master/Image/lock.png?raw=true)
示意圖

小明把寫的情書放在盒子裡面，然後再傳密碼給小美，這樣小美就可以用密碼打開盒子看到小明給他的情書，就這樣熱戀過了幾個月，小明有天覺得奇怪在走廊上為何有人會對他指指點點露出奇妙的微笑，結果發現原來是當初傳密碼給小美時被中間班級的單身狗，姑且就叫他小單，給攔截了，所以往後他們精美的盒子在班級間傳來傳去，都被小單用密碼解開然後拿著小明的情書在班上供大家傳閱，小明覺得很幹但又不能不傳情書給小美，於是小明跑去十分瀑布下面打坐了三天三夜(這個在他日後寫留言板系統也做了一樣的事情)，就在第三天的晚上，他遇到冥王雷利，雷利在他盒子鍍上一層膜，但這層膜並不是丟到人魚島不會濕掉，這層膜是一個只能用指紋打開的高科技保護膜，小明很開心將這盒子傳給小美，小美便把情書放在這個盒子裡面並關起來傳給小明，中間小單擷取到這個盒子也沒法度，因為他沒有小明的指紋可以開著盒子阿，可....可惡，所以小明拿到盒子後順利用自己的指紋打開就看到充滿愛意的情書囉。

所以公鑰就是這個盒子，私鑰就是指紋，情書就是檔案，從頭到尾私鑰都沒有傳出去，和一開始最大差別在於，小明必須把公鑰密碼傳給小美，這就是對稱加密 : AES（Advanced Encryption Standard），加密解密都是用同一個 key，但傳送過程就有風險可能被小單截取走 key 碼。而後來加了私鑰(小明指紋)就沒這問題囉，這就是非對稱加密 RSA

### 雜湊（Hashing） :
把各個欄位/字元 丟進去某個公式計算的方式就叫做雜湊（Hash）
#### 特性 :

1. 不可逆
2. 輸入同樣的值，一定會得到同樣的值
3. 不一樣的長度輸入，可以得到固定長度的 hash 碼
4. 不同輸入可能得到相同的 hash 碼(但機率極低)
5. 輸入只差一點點，但輸出可能天差地遠

因此駭客即使知道了hash 碼，也難以輕易解碼。如果是本人要登入的話，主機只要對輸入的密碼做雜湊，去比對是不是符合儲存的雜湊值就可以了。

#### Hash (雜湊)演算法

- SHA-0
- SHA-1 ( 已經被證明不夠安全。 2017年荷蘭密碼學研究小組 CWI 和Google 正式宣布攻破了SHA-1)
- SHA-256
- MD-5 (已經被證明不夠安全。 1996年後被證實存在弱點，可以被加以破解 ；2004年，證實 MD5 演算法無法防止碰撞)
- RIPEMD-160


*************

## `include`、`require`、`include_once`、`require_once` 的差別
相同 :

- 都是引入或匯入檔案

差別 :

- 後面有 once 的就是只有匯入一次，如果沒有使用後面有 once ，那可能會將同一個檔案匯入兩次，便會發生錯誤

- 而 `include` 和 `require` 的差別在於，`include` 的檔案沒有被找到，程式依舊會執行，所以像是留言板作業，我們要匯入資料庫的帳號密碼，由於一定要匯入所以使用 `require`，同時也避免重複輸入造成錯誤，所以會使用 `require_once '檔案名稱';`

## 請說明 SQL Injection 的攻擊原理以及防範方法
### 攻擊原理 : 
SQL Injection 是攻擊者使用資料庫語法入侵網站的資料庫，會有這個問題是因為攻擊者可以在任何使用者可以輸入的地方攻擊
舉例 :
![](https://static.coderbridge.com/img/tzutzu858/b93326ad7c514003aaf7eaec498bfd4e.png)
直接擷取 Huli 影片內容

###  SQL Injection 防範 : 
用 MySQL數據庫支持準備好的語句 `Prepared Statements` ，其實就是把使用者輸入的內容指定型別，就不會有問題了
 `Prepared Statements`  用法 :
```
$sql = "INSERT INTO table_name(nickname, content) VALUE(?, ?)" // 參數改成 ?;
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $nickname, $content); //兩個參數都是字串，就打SS
```
`bind_param('ss', $nickname, $content);`
`bind_param()` 該函式繫結了 SQL 的引數，且告訴資料庫引數的值。 `'ss'` 引數列處理其餘引數的資料型別。`s` 字元告訴資料庫該引數為字串。

引數有以下四種型別:
i – integer（整型）
d – double（雙精度浮點型）
s – string（字串）
b – BLOB（布林值）

##  請說明 XSS 的攻擊原理以及防範方法
Cross-site scripting 跨網站指令碼，是代碼注入的一種，我自己的理解是和 SQL Injection 有點像，因為都是使用者注入式攻擊，所以使用者在任何自已可以輸入的地方，寫入任何 Script 去執行程式，或是用個普通的 HTML 也可以，在 OWASP Top Ten 在 2013 版本是第三名，2017 已經變成第七名。
###  XSS 防範 : 
php 有提供內建的 function 叫做 `htmlspecialchars`，他可以把特殊的字元，編碼成另一個，例如 `<` 編碼成 `&lt;`，那這個 `&lt;` 會被 html 解釋成小於這個符號，而不是小於這個 tag，這個 htmlspecialchars 會建議在顯示的時候做，讓資料庫保持使用者輸入的內容。

## 請說明 CSRF 的攻擊原理以及防範方法
CSRF ( Cross Site Request Forgery )，跨站請求偽造，又稱作 one-click attack 因為點一下就中招了，CSRF 像披著羊皮的狼，主要攻擊方式就是在不同 domin 底下卻能夠偽造使用者本人發出 request 。
防範方法 : 
1. 使用者防禦 : 每次都登出就好，但沒啥用又麻煩。
2. server 防禦 : (1) 檢查 referer (2) 加圖形驗證、簡訊驗證 (3) 加上 CSRF token (4) Double Submit Cookie ，這個也可以是 client 產生，反正就是讓攻擊者猜不到 cookie。
3. browser 防禦 : Chrome 51 版加入 SameSite cookie