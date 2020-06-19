## 請解釋後端與前端的差異。

### 什麼是前端？
前端就是你打開瀏覽器，看到那些花花綠綠的網頁，有排版或是按鈕互動，都是前端要做的事。
舉老師某篇文章用販賣機來譬喻，你看到販賣機上面有賣什麼飲料，有按鈕可以讓你選，一切你所看的到的東西，就是前端。

### 什麼是後端？
後端主要著重在功能與資料儲存，像是註冊會員，資料儲存等等。
像是有些販賣機有會員功能(EX:口罩機)，後端就會儲存誰買了口罩，有資料儲存才知道每天多少人去買口罩，這個月要補多少貨。


## 假設我今天去 Google 首頁搜尋框打上：JavaScript 並且按下 Enter，請說出從這一刻開始到我看到搜尋結果為止發生在背後的事情。

1. 網頁叫瀏覽器送出
2. 瀏覽器叫作業系統送出
3. 作業系統叫網路卡送出
4. 於是網路卡發出`request`到 Google Server
5. 中間經過家裡網路、社區網路、台灣網路、美國網路到 Google Server
6. Google Server 會把`request`的訊息存到 database 
7. Google Server 發出`response`到網路卡
8. 網路卡解析完給作業系統，作業系統解析完在給瀏覽器，然後瀏覽器才顯示出來


## 請列舉出 3 個「課程沒有提到」的 command line 指令並且說明功用
1. `cat <file>`  將檔案內容輸出在終端機上
2. `echo "my content" > <file>`   取代原本的檔案內容
3. `echo "my content" >> <file>`   添加到原本的檔案內容
4. `mv <file-old> <file-new>`  EX:`mv afu.js hihi.js` 將afu.js重新命名hihi.js
5. `mv <file> folder/`   EX:`mv afu.js hihi/`   將afu.js移到hihi資料夾裡(資料夾要在同一層，不然會顯示No such file or directory) 
