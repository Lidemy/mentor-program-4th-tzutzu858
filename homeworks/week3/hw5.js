/* eslint-disable no-param-reassign */
/* eslint-disable consistent-return */
const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', line => lines.push(line));

function compare(a, b, k) {
  if (a === b) return 'DRAW';

  if (Number(k) === -1) {
    const tmp = a;
    a = b;
    b = tmp;
  }

  const numA = a.length;
  const numB = b.length;
  if (numA !== numB) {
    return numA > numB ? 'A' : 'B';
  }

  for (let i = 0; i < numA; i += 1) {
    if (a[i] !== b[i]) {
      return a[i] > b[i] ? 'A' : 'B';
    }
  }
}

function solve(lin) {
  const n = lin[0];
  for (let i = 1; i <= n; i += 1) {
    const tmp = lin[i].split(' ');
    const a = tmp[0];
    const b = tmp[1];
    const k = tmp[2];
    console.log(compare(a, b, k));
  }
}
rl.on('close', () => solve(lines));
