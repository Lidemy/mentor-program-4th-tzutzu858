/* eslint-disable no-restricted-syntax */
const request = require('request');

const CLIENT_ID = '99pjv6inn1ogsvbt7as7rqyc26jk7f';
const BASE_URL = 'https://api.twitch.tv/kraken';


request({
  method: 'GET',
  url: `${BASE_URL}/games/top`,
  headers: {
    'Client-ID': CLIENT_ID,
    Accept: 'application/vnd.twitchtv.v5+json',
  },
}, (err, res, body) => {
  if (err) {
    return console.log(err);
  }

  const data = JSON.parse(body);
  const games = data.top;
  function getTopGame(Topgames) {
    for (const game of Topgames) {
      console.log(`${game.viewers} ${game.game.name}`);
    }
  }
  return getTopGame(games);
});
