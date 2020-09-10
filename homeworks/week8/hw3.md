## 什麼是 Ajax？
傳送資料有幾種方法:其中一種是透過 form 表單，但缺點是每次換資料都要換頁，因此不換頁也能跟 Server 溝通，Server 會回傳 response 給 JavaScript 的方式就叫做 AJAX。
AJAX ( Asynchronous JavaScript and XML ) 非同步的 JavaScript 與 XML 技術。早期都是用 XML 做為資料格式，現在比較多都用 JSON 格式，但還是可以叫 AJAX。AJAX 在 JavaScript 中，是透過 XMLHttpRequest 建立一個物件，設定 URL 與 method 然後送出 request，並等待伺服器 response 後，透過 callback function 來進行後續動作，所以這週作業我都只是根據傳回來的 response 去動態更改一些中獎資訊的圖片( hw1 )，或是秀出最熱門遊戲( hw2 )，而不用整個頁面都換掉， 這就是 AJAX。這週作業至始至終都在同一個頁面，不會有跳轉到新頁面(網址)的情況，這種應用就稱為 SPA 單頁應用(single-page application)，但因為都是 JavaScript 產生內容，而 SEO (搜尋引擎最佳化)讀取 HTML 時，那些動態產生的內容都不會讀取到，所以又需要SSR(Server-Side Rendering)，也就是第一次的畫面是從 Server 端來的，這樣 SEO 有吃到資訊覺得開心，使用者也不會操作時一直跳頁面，皆大歡喜。
參考文章 : Huli 的 [跟著小明一起搞懂技術名詞：MVC、SPA 與 SSR](https://medium.com/@hulitw/introduction-mvc-spa-and-ssr-545c941669e9)
第四週看過一遍，第八週再看一遍感覺更懂了(應該吧)


## 用 Ajax 與我們用表單送出資料的差別在哪？
- 相同 : 
1. 安全性都一樣，都是發送的http協議

- 差異:
1. 用表單提交，點擊提交觸發submit事件，會使頁面發生跳轉，而頁面的跳轉等行為的控制往往在後端。
用 ajax ，透過 JavaScript 來操作頁面的跳轉或數據變化，控制權則是在前端。
2. ajax 提交時，是在後台新建一個請求，form 表單卻是放棄本頁面，然後再請求。
3. ajax 因為是透過 JavaScript 來實現，所以會有瀏覽器兼容問題，而且如果你的瀏覽器沒有啟用 JavaScript ，就無法完成操作，form 表單是瀏覽器自帶的，所以瀏覽器有無開啟 JavaScript，都可以提交表單。
4. 適用場景 : 如果我今天提交後要跳轉到其他新頁面，適合用 form ，但如果我提交完要展示後端返回的處理資訊，那就適合用 ajax

## JSONP 是什麼？
傳送資料除了用上述說的表單或是用 AJAX
還有就是 JSONP ，但現在很少人在用，全名 JSON with padding
有這方法的誕生主要是因為 Same-origin policy 同源政策，就是在瀏覽器上兩份網頁要具備相同協定、埠號 (如果有指定) 以及主機位置才能交換資料，不然就是 server 給你的 response header 要有 `Access-Control-Allow-Origin` ，才能拿到 response 。但有些標籤不受到同源政策影響，例如 : 
1. 圖片 : 就算跨來源的圖片一樣可以載入，因為圖片沒有安全性的問題
2. <script src="可以引入其他 domain 的 js 進來"> 為了方便
所以就有人利用 script 這個標籤來拿到資料
比如說 load 一個 script ，那他回傳的內容可以是一個 function ，裡面夾帶他真正要回傳的資料，這就是 JSONP 

## 要如何存取跨網域的 API？
上一題所提到的 server 給你的 response header 要有 `Access-Control-Allow-Origin` ，這就是跨來源資源共用（CORS）Cross-Origin Resource Sharing，其實不管有沒有加 `Access-Control-Allow-Origin` ，都是有 Request 出去 ，Response 回來，只是差別在於當我的瀏覽器收到 Response ，會先檢查 `Access-Control-Allow-Origin` 裡面的內容，例如`Access-Control-Allow-Origin: *` 表示允許任何網域跨站存取資源，才會讓你的程式順利接收到 Response，有了 CORS 就可以存取跨網域的 API。

## 為什麼我們在第四週時沒碰到跨網域的問題，這週卻碰到了？
因為 Same-origin policy 同源政策 只有在瀏覽器上才有這限制，所以第四週是在 node.js 執行 JavaScript 來串API，自然就沒有跨網域的限制。

