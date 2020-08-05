## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。
### 1. `<hr />`分隔線
屬性有 : align、size、width、color、noshade
舉例 : `<hr width="100" align="center" noshade />`

###  2. `<textarea></textarea>` 有文字區域的表單
屬性有 : name、id、cols、rows、disabled ( 沒有作用 )、readonly ( 不能操作 )、wrap ( 參數：off、virtual、physical )
舉例 : `<textarea name="read" cols="10" rows="3" readonly>value</textarea>`

###  3. `<b>粗體文字</b>` 、`<i>斜體文字</i>`、`<u>底線文字</u>`

## 請問什麼是盒模型（box model）
CSS 裡面，html 的每個元素都可被視作為一個盒子，然後可以針對這個盒子去做調整。
一個 Box 由以下屬性組成：margin 、 padding 、 border 、 content 。
要注意的是，設計師跟你說要 200px * 100px，自己還要加加減減扣掉 border 和 margin，非常麻煩，所以可以利用 box-sizing
`box-sizing: content-box;` 內容物寬高
`box-sizing: border-box;` 意思是把 border 和 margin 都會考慮進來

## 請問 display: inline, block 跟 inline-block 的差別是什麼？
- block : 元素寬度預設會撐到最大，使其占滿整個容器，多個元素會換行來呈現，並不會併排，div， h1， p...調什麼都可以。
- inline 行內元素 : 預設代表 span， a 。調寬高沒用，元素的寬高是根據內容決定，上下邊距沒用，只有左右會變。
- inline-block  : 是混血兒，有 block 和 inline 的優點，對外像 inline 可併排，對內像 block 可調各種屬性。

## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？

- static : **不會被特別定位**在頁面上特定位置，而是照著瀏覽器預設的配置自動排版在頁面上。

- relative : 在一個設定為 position: relative 的元素內設定 top 、 right 、 bottom 和 left 屬性，會使其元素「相對地」調整其原本該出現的所在位置，而不管這些「相對定位」過的元素如何在頁面上移動位置或增加了多少空間，都不會影響到原本其他元素所在的位置。


- absolute : 某個參考點做定位，往上找不是 static 做定位

- fixed : 相對於瀏覽器做定位，即便頁面捲動，它還是會固定在相同的位置。和 relative 一樣，會使用 top 、 right 、 bottom 和 left 屬性來定位。




