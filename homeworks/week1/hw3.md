## 教你朋友 CLI

### 什麼是command line?

1. 要知道command line，首先要先知道我們平常在操作電腦幾乎都是圖形使用者介面( Graphical User Interface，GUI）
2. GUI 意思是我們用圖形方式來操作電腦和電腦溝通。
3. 而另一種和電腦溝通的方式就是以純文字溝通，叫做 CLI，也就是 Command Line Interface。

### 環境設置

1. 不同的作業系統用 CLI 的程式就會有所不同。
2. Windows 內建有 CMD (命令提示字元)，但推薦使用 Git Bash，它是基於 CMD 的，在 CMD 的基礎上增添一些新的命令與功能。不過 Git Bash 命令行使用的是 mintty 終端,而 mintty 終端並不能完全替代 cmd ,也沒有提供包管理工具供我們擴展第三方命令。
3. Mac 內建有 Terminal  終端機，會建議使用 iTerm2，在裡面選一個喜歡的 color scheme ，使用 CLI 更清楚。

### command line基本指令

你想要 command line 建立一個叫做 wifi 的資料夾，並且在裡面建立一個叫 afu.js 的檔案，那就要來學一些基本command line基本指令。

1. 建立使用的命令是`mkdir`，是MaKe DIRectory的縮寫，因此輸入`mkdir wifi`就成功建立一個叫做 wifi 的資料夾。
2. 接著我們要進入到剛剛建立好的 wifi 的資料夾，可以下`cd wifi`指令， cd 是 Change Directory 的縮寫。
3. 建立一個叫 afu.js 的檔案，下`touch afu.js`指令，這個 touch 意思是碰一下檔案，會發現檔案最後時間會更新，但如果 touch 一個不存在的檔案，它就會幫你新建檔案。注意在Windows裡的 CMD 沒有`touch`這個指令，用 Git Bash 或是你使用的作業系統是Mac/Linux都是沒問題的。
4. 接著你想要確認一下剛剛是否真的建立成功，若是使用 Git Bash 可以下`ls`或`dir`指令，ls 是 List Segment 的縮寫，如果是 Mac 環境只能下`ls`指令，而 Windows 環境只能下`dir`指令。

你想要的功能就都完成了，這邊再介紹一些其他基本功能

| Windows        | Mac/Linux                        |說明                | 
| -------------- | -------------------------------- | -------------------| 
| `cd`           | `pwd` Print Working Directory    | 取得目前所在的位置  |
| `dir`          | `ls`  List Segment               | 列出目前的檔案列表  |
| `cd`           | `cd` Change Directory            | 切換目錄           |
| 無             | `touch`                          | 建立檔案           |
| `mkdir`        | `mkdir`  MaKe DIRectory          | 建立新的目錄       |
| `del`          | `rm` ReMode                      | 刪除檔案           |
| `copy`         | `cp`  CoPy                       | 複製檔案           |
| `move`         | `mv` MoVe                        | 移動檔案           |

mac 使用說明 --> MANual  `man`




