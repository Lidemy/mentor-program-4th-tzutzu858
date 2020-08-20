/* eslint-disable no-restricted-globals */
/* eslint-disable no-alert */
/* eslint-disable no-restricted-syntax */

document.querySelector('form').addEventListener('submit',
  (e) => {
    e.preventDefault();
    const activityName = document.querySelectorAll('.input-block');
    const radio = document.getElementById('1').checked;
    const radio2 = document.getElementById('2').checked;
    let hasNull = false;
    let formText = '';
    for (const inputName of activityName) {
      const errP = inputName.querySelector('p');
      const inputValue = inputName.querySelector('input');
      if (inputValue.value) {
        errP.className = 'input-ok';
        const titleName = inputValue.parentNode.parentNode.querySelector('.input-block_title').innerText;
        formText += `${titleName} : `;
        formText += `${inputValue.value} \n`;
      } else {
        errP.className = 'input-err';
        hasNull = true;
      }
    }
    if (!radio && !radio2) {
      document.querySelector('.input-block-radio p').className = 'input-err';
      hasNull = true;
    } else {
      document.querySelector('.input-block-radio p').className = 'input-ok';
      if (radio) {
        formText += '報名類型 : 躺在床上用想像力實作 \n';
      } else formText += '報名類型 : 趴在地上滑手機找現成的 \n';
    }

    if (!hasNull) {
      const suggest = document.querySelector('input[name=suggest]');
      const titleName = suggest.parentNode.parentNode.querySelector('p');
      console.log(suggest.value);
      if (suggest.value) {
        formText += `${titleName.innerText} : `;
        formText += `${suggest.value} \n`;
      }
      confirm(`您填寫的資料是: \n \n${formText} `);
    }
  });

/*

原本想要把值傳到 function 裡，
去做判斷 input 裡面是否為空，增加<p>標籤，
但看了老師方法比較好就改掉了，
因為用原本的方法會小跑版

function setAlert(name) {
  const element = document.querySelector(`.input - block_${ name } `);
  const del = document.querySelector(`.input - block_${ name } .attention`);
  if (document.querySelector(`input[name = ${ name }]`).value === '') {
    if (!del) {
      const item = document.createElement('p');
      item.innerText = '必填項目沒填';
      element.appendChild(item);
      item.classList.add('attention');
    }
  } else if (del) {
    element.removeChild(del);
  }
}

document.querySelector('form').addEventListener('submit',
  (e) => {
    e.preventDefault();
    setAlert('nickname');
    setAlert('email');
    setAlert('phone');
    setAlert('referal');
  });

*/
