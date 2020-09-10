/* eslint-disable consistent-return */
/* eslint-disable no-restricted-syntax */
/* eslint-disable no-inner-declarations */
/* eslint-disable func-names */
const CLIENT_ID = '99pjv6inn1ogsvbt7as7rqyc26jk7f';
const BASE_URL = 'https://api.twitch.tv/kraken';
const STREAM_TEMPLATE = `<div class="stream_card">
<img src="$preview" />
<div class="stream__data">
    <div class="stream__avatar">
        <img src="$logo">
    </div>
    <div class="stream__intro">
        <div class="stream__title">$title</div>
        <div class="stream__channel">
            $name
        </div>
    </div>
</div>
</div>`;

// https://developer.mozilla.org/zh-TW/docs/Web/API/XMLHttpRequest
// 設定 HTTP 請求標頭（request header）值。setRequestHeader() 可被呼叫的時間點必須於 open() 之後、在 send() 之前。
// setRequestHeader 是遞交到 server 的

function getStreams(name, callback) {
  const requestLiveStreams = new XMLHttpRequest();
  requestLiveStreams.open('GET', `${BASE_URL}/streams?game=${encodeURIComponent(name)}&limit=20`, true); // encodeURIComponent : 會處理#字元為%23，空白字元轉換為%20，中文字處理為UTF-8
  requestLiveStreams.setRequestHeader('Accept', 'application/vnd.twitchtv.v5+json');
  requestLiveStreams.setRequestHeader('Client-ID', CLIENT_ID);
  requestLiveStreams.send();
  requestLiveStreams.onload = function () {
    if (requestLiveStreams.status >= 200 && requestLiveStreams.status < 400) {
      const streamsResponse = requestLiveStreams.responseText;
      const data = JSON.parse(streamsResponse).streams;
      callback(data);
    } else console.log(requestLiveStreams.status);
  };
}

// 只有得到遊戲資料
function getGames(callback) {
  const requestGameTop = new XMLHttpRequest();
  requestGameTop.open('GET', `${BASE_URL}/games/top?limit=5`, true);
  requestGameTop.setRequestHeader('Accept', 'application/vnd.twitchtv.v5+json');
  requestGameTop.setRequestHeader('Client-ID', CLIENT_ID);
  requestGameTop.send();
  requestGameTop.onload = function () {
    if (requestGameTop.status >= 200 && requestGameTop.status < 400) {
      const response = requestGameTop.responseText;
      const gameData = JSON.parse(response);
      const games = gameData.top;
      callback(games);
    } else console.log('error');
  };

  requestGameTop.onerror = function () {
    console.log('error');
  };
}

function changeGame(gameName) {
  document.querySelector('.game_title').innerText = gameName;
  document.querySelector('.streams').innerHTML = '';
  getStreams(gameName, (streams) => {
    for (const stream of streams) {
      const element = document.createElement('div');
      document.querySelector('.streams').appendChild(element);
      element.outerHTML = STREAM_TEMPLATE
        .replace('$preview', stream.preview.large)
        .replace('$logo', stream.channel.logo)
        .replace('$title', stream.channel.status)
        .replace('$name', stream.channel.name);
    }
  });
}

getGames((games) => {
  const navbarList = document.querySelector('.navbar_list');
  for (const game of games) {
    const ul = document.createElement('ul');
    ul.classList.add('navbar_list');
    ul.innerHTML = `
    <li class='topGamesOfFive'>${game.game.name}</div>
    `;
    navbarList.appendChild(ul);
  }
  changeGame(games[0].game.name);
});

document.querySelector('.navbar_list').addEventListener('click', (e) => {
  if (e.target.tagName.toLowerCase() === 'li') {
    const gameName = e.target.innerText;
    changeGame(gameName);
  }
});
