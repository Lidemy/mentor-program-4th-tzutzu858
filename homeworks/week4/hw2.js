const request = require('request');

const action = process.argv[2];
const params = process.argv[3];
const newName = process.argv[4];
const BaseURL = 'https://lidemy-book-store.herokuapp.com';


switch (action) {
  case 'list':
    request(`${BaseURL}/books?_limit=20`, (err, res, body) => {
      if (err) {
        return console.log('抓取失敗', err);
      }

      let bookData;
      try {
        bookData = JSON.parse(body);
      } catch (error) {
        return console.log(error);
      }
      function listBook(Data) {
        for (let i = 0; i < Data.length; i += 1) {
          console.log(`${Data[i].id}. ${Data[i].name}`);
        }
      }
      return listBook(bookData);
    });
    break;

  case 'read':
    request(`${BaseURL}/books/${params}`, (err, res, body) => {
      if (err) {
        return console.log('抓取失敗', err);
      }

      let bookData;
      try {
        bookData = JSON.parse(body);
      } catch (error) {
        return console.log(error);
      }

      function readBook() {
        if (res.statusCode < 300 && res.statusCode >= 200) {
          console.log(bookData.id, bookData.name);
        } else console.log(res.statusCode);
      }

      return readBook();
    });
    break;

  case 'delete':
    request.delete(`${BaseURL}/books/${params}`, (err, res) => {
      if (res.statusCode < 300 && res.statusCode >= 200) {
        return console.log(`你已刪除 id 為 ${params} 的書籍`);
      } return console.log('刪除失敗', err);
    });
    break;

  case 'create':
    request.post({
      url: `${BaseURL}/books`,
      form: {
        name: params,
      },
    }, (err, res, body) => {
      let bookData;
      try {
        bookData = JSON.parse(body);
      } catch (error) {
        return console.log(error);
      }

      if (res.statusCode < 300 && res.statusCode >= 200) {
        return console.log(`你已新增一本 id 為 ${bookData.id} 的《${bookData.name}》的書籍`);
      } return console.log('新增失敗', err);
    });
    break;
  case 'update':
    request.patch({
      url: `${BaseURL}/books/${params}`,
      form: {
        name: newName,
      },
    }, (err, res) => {
      if (res.statusCode < 300 && res.statusCode >= 200) {
        return console.log(`你已將 id 為 ${params} 的書籍名更新為《${newName}》`);
      } return console.log('更新失敗', err);
    });
    break;

  default:
    break;
}
