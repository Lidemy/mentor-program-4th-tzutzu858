document.querySelector('.faq').addEventListener('click',
  (e) => {
    const closestElement = e.target.closest('.desc');
    closestElement.querySelector('span').classList.toggle('text');
  });
