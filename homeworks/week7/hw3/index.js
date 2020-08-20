function escapeHtml(unsafe) {
  return unsafe
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;');
}

document.querySelector('.btn-new').addEventListener('click', () => {
  const element = document.querySelector('.input-todo'); // 可以直接使用 {value} ，ES6 的解構賦值
  if (!element.value) return;
  const div = document.createElement('div');
  div.classList.add('todo');
  div.innerHTML = `
      <div class="todo_block">
      <input class="todo_check" type="checkbox" />
      <div class="todo_title">${escapeHtml(element.value)}</div>
      </div>
      <button class="btn-delete">delete</button>
    `;
  document.querySelector('.todos').appendChild(div);
  document.querySelector('.input-todo').value = '';
});

document.querySelector('.todos').addEventListener('click', (e) => {
  const { target } = e;

  if (target.classList.contains('btn-delete')) {
    target.parentNode.remove();
    return;
  }

  if (target.classList.contains('todo_check')) {
    if (target.checked) {
      target.parentNode.classList.add('done');
    } else {
      target.parentNode.classList.remove('done');
    }
  }
});
