/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************************!*\
  !*** ./resources/admin/js/accordeon.js ***!
  \*****************************************/
var headers = Array.from(document.querySelectorAll('.conf-step__header'));
headers.forEach(function (header) {
  return header.addEventListener('click', function () {
    header.classList.toggle('conf-step__header_closed');
    header.classList.toggle('conf-step__header_opened');
  });
});
/******/ })();

var trashs = Array.from(document.querySelectorAll('.conf-step__button-trash'));
var hallAddPopupShowBtn = document.getElementById('hallAddPopupShow');

var delModal = document.getElementById('deletePopup');
var addModal = document.getElementById('addPopup');
var addMovieModal = document.getElementById('addMoviePopup');

var deleteDismiss = document.getElementById('delModalDissmis');
var addDismiss = document.getElementById('addModalDissmis');
var movieDismiss = document.getElementById('movieModalDissmis');
var cancelBtn = Array.from(document.querySelectorAll('.conf-step__button-regular'));
var addMovieBtn = document.getElementById('addMovie');


var ul = Array.from(document.querySelectorAll('.hallDeleteList'));
var popupSpan = document.querySelector('.popupHallName');
var myForm = document.getElementById("deleteForm");
var addMivieForm = document.getElementById("addMivieForm");

var addMovieToDbBtn = document.getElementById('addMovieToDbBtn');
var addMovieInput = document.getElementById('addMovieInput')

var chairsHallConfInput = document.getElementsByName("chairs-hall");
var chairsPrice = Array.from(document.getElementsByName("prices-hall"));
var standartPriceInput = document.getElementById('standartPrice');
var vipPriceInput = document.getElementById('vipPrice');
var savePriceBtn = document.getElementById('savePrice')


//Delete-Popup show
for (let i = 0; i < trashs.length; i++) {
  trashs[i].addEventListener('click', function() {
    delModal.classList.toggle('active');
    popupSpan.textContent = ul[i].textContent;
    myForm.action = `/admin/delete_hall/${trashs[i].id}`
  })
}
//Delete-Popup close
deleteDismiss.addEventListener('click', function(e) {
  e.preventDefault();
  delModal.classList.toggle('active');
})
//Add-Popup show
hallAddPopupShowBtn.addEventListener('click', function() {
  addModal.classList.toggle('active');
})
//Add-Popup close
addDismiss.addEventListener('click', function(e) {
  e.preventDefault();
  addModal.classList.toggle('active');
})
//Cancel-Buttons
for (let i = 0; i < cancelBtn.length; i++) {
  cancelBtn[i].addEventListener('click', (e) => {
    e.preventDefault();
    location.reload(true)
  })
}
//Movie-Popup show
addMovieBtn.addEventListener('click', function() {
  addMovieModal.classList.toggle('active');
})
//Movie-Popup close
movieDismiss.addEventListener('click', function(e) {
  e.preventDefault();
  addMovieModal.classList.toggle('active');
})

for (let i = 0; i<chairsHallConfInput.length; i++) {
  chairsHallConfInput[i].addEventListener('click', function(e) {
    console.log('das')
    // addMovieModal.classList.toggle('active');
  })
}

// for (let i = 0; i<chairsHallConfInput.length; i++) {
//   chairsPrice[i].addEventListener('click', function(e) {
//     console.log(chairsPrice[i].checked)
//     // addMovieModal.classList.toggle('active');
//   })
// }
//Конфигурация цен

  chairsPrice.forEach(hall => hall.addEventListener('click', function() {
    savePriceBtn.addEventListener('click', () => {
      location = `/admin/save_price/${hall.value}/${standartPriceInput.value}/${vipPriceInput.value}`
    
    })
  }))






const chairChecked = () => {
  const chairs = Array.from(document.querySelectorAll('.conf-step__row  .conf-step__chair'));
  chairs.forEach(chair => chair.addEventListener('click', () => {
      // Переключение типов кресел
      if (chair.classList.contains('conf-step__chair_standart')) {
          chair.classList.toggle('conf-step__chair_standart');
          chair.classList.toggle('conf-step__chair_vip');
      } else if (chair.classList.contains('conf-step__chair_vip')) {
          chair.classList.toggle('conf-step__chair_vip');
          chair.classList.toggle('conf-step__chair_disabled');
      } else if (chair.classList.contains('conf-step__chair_disabled')) {
          chair.classList.toggle('conf-step__chair_disabled');
          chair.classList.toggle('conf-step__chair_standart')
      };
  }));
}
// Поля ввода кол-ва рядов и мест в ряду
const inputRowsCount = document.getElementById('input_rows_count');
const inputPlacesCount = document.getElementById('input_places_count');

// Кол-во мест в ряду не может быть больше 20
if (inputPlacesCount.value > 20) {inputPlacesCount.value = "20"};

// Получаем кол-во рядов и мест в ряду в числовом виде
const rows = Number(inputRowsCount.value);
const places = Number(inputPlacesCount.value);

chairChecked();

console.log(addMovieInput.value);

// addMovieToDbBtn.addEventListener('click', function() {
//   addMovieModal.classList.toggle('active');
//   console.log(addMovieInput.value);
//     addMivieForm.action = `/admin/add_movie/${addMovieInput.value}`
//   })
