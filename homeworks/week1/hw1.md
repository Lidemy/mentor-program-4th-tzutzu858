## 交作業流程

1. 進到 GitHub classroom 指定的 repositiory(自己的)
2. 有綠色框框寫`Clone or download`
3. 按下後複製他給的 URL
4. 在CLI介面下，打`git clone <github 給的 URL>`
5. 可以去資料夾看有沒有真的 clone 下來
6. 新開一個 branch : `git branch week1`
7. 切換 branch : `git checkout week1`
8. 把所有檔案都加入版本控制 : `git add .`
9. commit : `git commit -am "自己寫敘述" `
10. push上去 : `git push origin <branch-name>`
11. 打開 GitHub repositiory 介面，有個 `Pull requests`按下去
12. 會有一個新提示，旁邊有綠色框框`Compare & pull request`按下去
13. 假設沒有新提示，也有綠色框框`New pull request`按下去
14. 把頁面打一打，有問題也可以在這邊問
15. 完成後按`Create pull request`
16. 之後到學習系統上，`作業列表`按`新增作業`並貼上PR(pull request)連結，(網址會有pull)
17. 助教改完會按 merge
18. 看到自己被 merge 後，切回master`git checkout master`
19. 拉下遠端的 master 到 local 端`git pull origin master`這樣就可以同步遠端已經 merge 的 master
20. 刪掉自己的 branch : `git branch -d week1`