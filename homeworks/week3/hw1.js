const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', line => lines.push(line));

function solve(lin) {
  const n = lin[0];
  let sum = '';
  for (let i = 1; i <= n; i += 1) {
    sum += '*';
    console.log(sum);
  }
}

rl.on('close', () => solve(lines));
