let cancelBtn = Array.from(document.querySelectorAll('.conf-step__button-regular'));
//Кнопка ОТМЕНА
for (let i = 0; i < cancelBtn.length; i++) {
    cancelBtn[i].addEventListener('click', (e) => {
      e.preventDefault();
      location.reload(true)
    })
  }