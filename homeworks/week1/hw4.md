## 跟你朋友介紹 Git

### Git 的基本概念
Git 是版本控制系統，為什麼要做版本控制，因為開發程式和系統過程會不斷重覆設計和修改。

### Git 基本指令

* `git init` 
在指定資料夾下按`git init`就可以對指定資料夾做版本控制

*  `git status` 
查看版本狀態

* `git rm -- cached <file>`
移除版本控制

* `git add .`
把所有檔案都加入版本控制
  
* `git commit -m "自己寫敘述" `
用來作版控的敘述

* `git log`
歷史紀錄

   P.S.如果有改檔案，都要先`git add <改過的檔案>`
   然後再`git commit -m "自己寫敘述"`

   更方便的方法: 
   原本要先`git add .`再 `git commit -m "自己寫敘述" `
   可以直接用`git commit -am "自己寫敘述" `
   `a`是all的意思
   但是如果有新檔案用`git commit -am "自己寫敘述" `並不會把新的檔案commit進來
   還是要先`git add .`再 `git commit`



* `git log --oneline`    顯示比較簡短的log

* `git checkout <A版本名稱>`  回到A版本

* `git checkout master`  回到最新的狀態

* `git diff`可以看出在commit之前改了什麼東西，按`q`可以出來

* `.gitignore` 版控裡想要忽略的檔案(意思是不讓特定檔案版控)

作法:
先`touch .gitignore`
`vim .gitignore` 把不要版控的檔案寫入

### Git branch基本指令

* `git branch -v` 可以看出現在有哪些branch
  
* `git branch <AAA>`  新增一個叫AAA的 branch

* `git branch -d <AAA>`  刪除一個叫AAA的 branch

* `git checkout <branch-name>`  切到指定的branch

* `git merge <AAA>` 把AAA合併進來我現在的branch

### Git 狀況劇

* 想改 commit message
`git commit --amend`會進到vim裡去改

* 我 commit 了可是我又不想 commit 了
`git reset HEAD^` 預設值是`--mixed`回到沒有 commit 狀態，沒有`git add`，檔案所修改的內容都還在
`git reset HEAD^ --hard` 回到上一版,檔案也回到上一版的內容
`git reset HEAD^ --soft` 回到沒有 commit 狀態，但有`git add`，檔案所修改的內容都還在

* 我還沒 commit，但我改的東西我不想要了
`git checkout --<檔案名>`檔案就會回到之前狀態
`git checkout --.`所有檔案都會回到之前狀態

* 改 branch 的名字
`git branch -m <新branch名>`

* 抓遠端的 branch
`git checkout <遠端 branch 名稱>`就會自動把你抓下來，並且切到剛剛所打的 branch


