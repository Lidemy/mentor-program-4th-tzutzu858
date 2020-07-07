const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', line => lines.push(line));

function isPrime(num) {
  for (let i = 2; i < num; i += 1) {
    if (num % i === 0) {
      return false;
    }
  }
  return true;
}

function solve(lin) {
  const n = Number(lin[0]);
  for (let i = 1; i <= n; i += 1) {
    if (Number(lin[i]) === 1) {
      console.log('Composite');
    } else if (isPrime(Number(lin[i]))) {
      console.log('Prime');
    } else console.log('Composite');
  }
}

rl.on('close', () => solve(lines));
