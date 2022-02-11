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
var addShowtimeModal = document.getElementById('addShowtimePopup');
var scheduleMovieItems = [...document.querySelectorAll('.conf-step__seances-movie')];
var delSheduleMovie = document.getElementById('delShowtimePopup');

var deleteDismiss = document.getElementById('delModalDissmis');
var addDismiss = document.getElementById('addModalDissmis');
var movieDismiss = document.getElementById('movieModalDissmis');
var showtimeDismiss = document.getElementById('showtimeModalDissmis');
var delShowtimeDismiss = document.getElementById('delShowtimeModalDissmis');

var cancelBtn = Array.from(document.querySelectorAll('.conf-step__button-regular'));
var addMovieBtn = document.getElementById('addMovie');


var ul = Array.from(document.querySelectorAll('.hallDeleteList'));
var popupSpan = document.querySelector('.popupHallName');
var popupMovieSpan = document.querySelector('.popupMovieName');
var myForm = document.getElementById("deleteForm");
var deleteSheduleForm = document.getElementById('delete_hall_shedule');
var addMivieForm = document.getElementById("addMivieForm");

var addMovieToDbBtn = document.getElementById('addMovieToDbBtn');
var addMovieInput = document.getElementById('addMovieInput')

var chairsHallConfInput = document.getElementsByName("chairs-hall");
var chairsPrice = Array.from(document.getElementsByName("prices-hall"));
var standartPriceInput = document.getElementById('standartPrice');
var vipPriceInput = document.getElementById('vipPrice');
var savePriceBtn = document.getElementById('savePrice')
var hallConfSaveBtn = document.getElementById('hallConfSaveBtn');
var hallsSeats = Array.from(document.querySelectorAll('.conf-step__hall'));

var hallConfRadio = [...document.querySelectorAll('.conf-step__radio.hide')];

var showtimeAdd = [...document.querySelectorAll('.conf-step__movie')];

var movieNameInput = document.querySelector('.movie_name');




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
  chairsHallConfInput[i].addEventListener('click', function() {
    hallsSeats.forEach(tab => {
        tab.style.display = 'none'
      })
      hallsSeats[i].style.display = "block";
  })
}

// Поля ввода кол-ва рядов и мест в ряду
const inputRowsCount = document.getElementById('input_rows_count');
const inputPlacesCount = document.getElementById('input_places_count');

// Обновление категории места !и колличества рядов в зале
hallConfSaveBtn.addEventListener('click', () => {
  if (inputRowsCount.value > 20) {inputRowsCount.value = "20"};
  if (inputPlacesCount.value > 20) {inputPlacesCount.value = "20"};
  const rows = Number(inputRowsCount.value);
  const places = Number(inputPlacesCount.value);
  let params = [];
  const hallConf = {
    'rows': rows,
    'cols': places
  }
  hallsSeats.forEach(tab => {
    if(tab.style.display === 'block') {
      var allHallChair = [...tab.querySelectorAll('.conf-step__chair')];
      var chairRow = [...tab.querySelectorAll('.conf-step__row')];
      
        var col = [...chairRow[0].querySelectorAll('.conf-step__chair')];
        let result = [];
        
        hallConfRadio.forEach(radio => {
          if(radio.checked) {
            for(let i = 0; i < chairRow.length; i++) {
              for(let j = 0; j < col.length; j++) {
                result.push({
                  'hall_id': radio.value,
                  'row_num': i,
                  'seat_num': j,
                  'status': 'standart'
                })
              }
            }
            for(let k = 0; k < allHallChair.length; k++) {
              result[k].status = allHallChair[k].className.slice(34)
            } 
          }
        }) 
        params.push(
          hallConf,
          result
        )
        location = `/admin/hall_chair/${JSON.stringify(params)}`;
    }
  })
})


//Конфигурация цен

  chairsPrice.forEach(hall => hall.addEventListener('click', function() {
    savePriceBtn.addEventListener('click', () => {
      const result = [{
        'hall_id': hall.value,
        'status': 'standart',
        'price': standartPriceInput.value,
      },
      {
        'hall_id': hall.value,
        'status': 'vip',
        'price': vipPriceInput.value
      },
    ];
    console.log(result)
      location = `/admin/save_price/${JSON.stringify(result)}`;
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


chairChecked();

//Schedules-add-Popup
showtimeAdd.forEach(movie => {
  movie.addEventListener('click', () => {
    let title = movie.querySelector('.conf-step__movie-title')
    addShowtimeModal.classList.toggle('active');
    movieNameInput.value = title.textContent
  })
})
showtimeDismiss.addEventListener('click', function(e) {
  e.preventDefault();
  addShowtimeModal.classList.toggle('active');
})

//Schedule-delete-Popup
scheduleMovieItems.forEach(movie => {
  movie.addEventListener('click', () => {
    delSheduleMovie.classList.toggle('active');
    let movieName = movie.querySelector('.conf-step__seances-movie-title').textContent;
    console.log(movieName)
    popupMovieSpan.textContent = movieName;
    console.log(movie.reviousSibling)
    // deleteSheduleForm.action = `/delete_hall_shedule/${movieName}`
  })
})
delShowtimeDismiss.addEventListener('click', function(e) {
  e.preventDefault();
  delSheduleMovie.classList.toggle('active');
})
//Delete-Popup show


