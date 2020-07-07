/* eslint-disable no-else-return */
const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', line => lines.push(line));

function solve(lin) {
  const tmp = lin[0];
  const m = Math.floor(tmp.length / 2);
  if (tmp.length % 2 === 0) { // �p�G�r��O����
    if (tmp[m] !== tmp[m - 1]) { // �r�ꤤ������Ӧr�����۵��L'False'
      console.log('False');
      return;
    } else {
      for (let i = 1; i < m; i += 1) {
        if (tmp[m + i] !== tmp[m - 1 - i]) {
          console.log('False');
          return;
        }
      }
    }
  } else { // �p�G�r��O���
    for (let i = 1; i <= m; i += 1) {
      if (tmp[m - i] !== tmp[m + i]) {
        console.log('False');
        return;
      }
    }
  }
  console.log('True');
}

rl.on('close', () => solve(lines));
