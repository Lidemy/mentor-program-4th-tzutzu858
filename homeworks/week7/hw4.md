## 什麼是 [DOM](https://developer.mozilla.org/zh-TW/docs/Web/API/Document_Object_Model)？
**在瀏覽器的 Javascript 引擎解讀 HTML、SVG 時，會將內容分析成一個個的 DOM，DOM就是把 document 轉換成 object ，便可以取得那些物件。**

**如何選到想要的元素：**
下面這些 function 都是放在 document 上面，所以都是以 document. 開頭

1. getElementsByTagName
`document.getElementsByTagName('div')`

2. getElementsByClassName
`document.getElementsByClassName('class_name')`

3. getElementById
`document.getElementById('id_name')`

4. getElementsByName
用 `.getElementsByName('name')` 來根據 name 這個屬性取得表單元素的值
他是 NodeList 集合，意味它會隨著有相同元素的新元素 name 添加到文檔中或從文檔中刪除而自動更新。

**以下算比較新出來的**

querySelector ： 後面接的是 css 的選擇器，只會回傳匹配到的第一個元素
`document.querySelector('#id_name')`
`document.querySelector('div')`
`document.querySelector('.class_name')`
`document.querySelector('div > a')`

querySelectorAll ： 會選到所有元素
`document.querySelectorAll('div')` 所有的 div 都會被選到

## 事件傳遞機制的順序是什麼；什麼是冒泡，什麼又是捕獲？

**事件傳遞順序 :**
當我們點擊 box 的事件時，click 會先傳給 window，一直往下傳，同一個事件再傳回來

![](https://static.coderbridge.com/img/tzutzu858/ba59c66fcbb246fe938c9767880404e5.png)
1. 先捕獲，再冒泡
2. 當事件傳到 target 本身，沒有分捕獲跟冒泡

- 捕獲階段：由 DOM 樹的最外層依序向內，過程中觸發個別元素的捕獲階段事件監聽。
- 目標階段：到達事件目標，依照註冊順序觸發事件監聽。
- 冒泡階段：由事件目標依序向外，過程中觸發個別元素的冒泡階段事件監聽。


## 什麼是 event delegation，為什麼我們需要它？
捕獲和冒泡階段一定會經過外層元素，因此可以將事件監聽註冊到外層元素上。這樣做的好處是是可減少監聽器的數目，不然有一百個相似功能的按鈕要新增一百個監聽，這很沒有效率，而且當我要動態新增和修改元素，不需要因為元素的改動而修改事件連結，不過 event delegation 的缺點是由於需要判斷哪些節點是我們要的，必須多寫一些程式碼做判斷。

## event.preventDefault() 跟 event.stopPropagation() 差在哪裡，可以舉個範例嗎？

- e.preventDefault : 取消瀏覽器的預設行為，和傳遞事件完全無關
- e.stopPropagation : 取消事件繼續往下傳遞

例如這週 hw1 表單作業，一開始就要用到 e.preventDefault ，不然當我按提交就是提交，才不會管我後面寫一大堆 js 做判斷的事情。

*****************
例如我在 box 監聽事件上加 e.stopPropagation()
那就只會 log "box click" 而不會印出上面的 "inner click"
![](https://static.coderbridge.com/img/tzutzu858/c94998290c2f4ffba2e70dbe48086cb2.png)
```js
document.querySelector('.box')
        .addEventListener('click', function (e) {
          e.stopPropagation()
          console.log('box click')
        })

document.querySelector('.inner')
        .addEventListener('click', function (e) {
          console.log('inner click')
        })
```