const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', line => lines.push(line));

function digitsCount(num) {
  let digits = 0;
  let m = num;
  while (m !== 0) {
    m = Math.floor(m / 10);
    digits += 1;
  }
  return digits;
}

function isNarcissistic(num) {
  let sum = 0;
  let m = num;
  const digitsNum = digitsCount(num);
  while (m !== 0) {
    sum += (m % 10) ** digitsNum;
    m = Math.floor(m / 10);
  }
  return sum === num;
}

function solve(lin) {
  const tmp = lin[0].split(' ');
  const n = Number(tmp[0]);
  const m = Number(tmp[1]);
  for (let i = n; i <= m; i += 1) {
    if (isNarcissistic(i)) {
      console.log(i);
    }
  }
}

rl.on('close', () => solve(lines));
