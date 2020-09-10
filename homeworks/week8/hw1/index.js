/* eslint-disable no-inner-declarations */
/* eslint-disable default-case */
/* eslint-disable no-alert */
/* eslint-disable func-names */
function changeLuckyBlock(prize) {
  const section = document.querySelector('.section');
  const wrapper = document.querySelector('.section .wrapper');
  const title = document.querySelector('.lucky_title');
  const btn = document.querySelector('.lucky_btn');

  title.style.color = 'black'; // 一律先把字變成黑色，如果是抽到 NONE 才把字換成白色
  wrapper.style.background = 'rgba(255,255,255,0.5)'; // 覺得抽獎圖片太亮了，字會不清楚，所以最外層蓋個半透明黑
  btn.style.visibility = 'visible';
  btn.innerText = '重新抽獎';
  switch (prize) {
    case 'FIRST': {
      section.style.backgroundImage = 'url(first.jpg)';
      title.textContent = '恭喜你中頭獎了！日本東京來回雙人遊！';
      break;
    }

    case 'SECOND': {
      section.style.backgroundImage = 'url(tv.jpg)';
      title.textContent = '二獎！90 吋電視一台！';
      break;
    }

    case 'THIRD': {
      section.style.backgroundImage = 'url(yt.jpg)';
      title.textContent = '恭喜你抽中三獎：知名 YouTuber 簽名握手會入場券一張，bang！';
      break;
    }

    case 'NONE': {
      section.style.background = 'black';
      title.textContent = '銘謝惠顧';
      title.style.color = 'white';
      break;
    }
  }
}

document.querySelector('.lucky_btn').addEventListener('click',
  () => {
    const request = new XMLHttpRequest();
    request.onload = function () {
      if (request.status >= 200 && request.status < 400) {
        const response = request.responseText;
        const json = JSON.parse(response);
        const bg = document.querySelector('.bg');
        const title = document.querySelector('.lucky_title');
        if (json.prize) {
          // 如果有回傳 prize ，就把文字、圖片、按鈕換掉，1.5秒後執行 changeLuckyBlock()
          bg.style.backgroundImage = 'url(magic.gif)';
          bg.style.backgroundSize = '100%';
          title.style.color = 'white';
          title.textContent = '祝您中大獎';
          const element = document.querySelector('.lucky_block');
          const msg = document.querySelector('.lucky_msg');
          document.querySelector('.lucky_btn').style.visibility = 'hidden';
          if (msg) {
            element.removeChild(msg);
            element.classList.remove('lucky_bg');
          }
          window.setTimeout((() => changeLuckyBlock(json.prize)), 1500);
        } else {
          alert('系統不穩定，請再試一次');
          console.log(request.status, request.responseText);
        }
      } else {
        alert('系統不穩定，請再試一次');
        console.log(request.status, request.responseText);
      }
    };
    request.onerror = function () {
      console.log('error');
    };
    request.open('GET', 'https://dvwhnbka7d.execute-api.us-east-1.amazonaws.com/default/lottery');
    request.send();
  });
