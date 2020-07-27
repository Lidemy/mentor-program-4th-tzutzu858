const request = require('request');

const API_URL = 'https://restcountries.eu/rest/v2';

const countryName = process.argv[2];

request(`${API_URL}/name/${countryName}`, (err, res, body) => {
  const countryData = JSON.parse(body);
  if (!countryName) {
    return console.log(`請輸入國家名稱,${res.statusCode}`);
  }

  if (res.statusCode < 500 && res.statusCode >= 400) {
    return console.log('找不到國家資訊', res.statusCode);
  }

  if (res.statusCode < 300 && res.statusCode >= 200) {
    for (let i = 0; i < countryData.length; i += 1) {
      console.log('============');
      console.log(`國家：${countryData[i].name}`);
      console.log(`首都：${countryData[i].capital}`);
      console.log(`貨幣：${countryData[i].currencies[0].code}`);
      console.log(`國碼：${countryData[i].callingCodes[0]}`);
    }
  }
  return console.log('抓取失敗');
});
