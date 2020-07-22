const request = require('request');

request('https://lidemy-book-store.herokuapp.com/books?_limit=10', (error, res, body) => {
  if (error) {
    return console.log('抓取失敗', error);
  }

  let bookData;
  try {
    bookData = JSON.parse(body);
  } catch (err) {
    return console.log(err);
  }

  function getBookName(book) {
    for (let i = 0; i < book.length; i += 1) {
      console.log(`${book[i].id}. ${book[i].name}`);
    }
  }

  return getBookName(bookData);
});
