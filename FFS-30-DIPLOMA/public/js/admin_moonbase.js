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

var trashs = Array.from(document.querySelectorAll('[data-delHall-id]'));
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
// var myForm = document.getElementById("deleteForm");
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

var dataEl = [...document.querySelectorAll('[data-movie-id]')];

var movieDeleteBtn = document.querySelector('.movie_delete_btn');

var startOfSalesRadio = [...document.getElementsByName("startOfSales-hall")];
var openHallParagraf = document.querySelector('.open-hall');
var startOfSalesBtnHide = document.querySelector('.startOfSalesBtnHide');
var startOfSalesBtn = document.querySelector('.startOfSalesBtn');


//Удаление зала
for (let i = 0; i < trashs.length; i++) {
  trashs[i].addEventListener('click', function() {
    delModal.classList.toggle('active');
    let id = trashs[i].getAttribute('data-delHall-id');
    popupSpan.textContent = ul[i].textContent;
    // myForm.action = `/admin/delete_hall/${id}`
    $(document).ready(function() {
      $('#hallDeleteForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
          url: "/delete_hall",
          type: 'POST',
          data: {
          hall_id: id 
          },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (data) {
            // console.log(data);
            location.reload();
          }
        });
      });
    })
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

//Добавление зала
 $(document).ready(function() {
      $('#hallAddForm').submit(function(e) {
        e.preventDefault();
        $hall_name = $('#hallNameAdd').val()
        $.ajax({
          url: "/hall_add",
          type: 'POST',
          data: {
          name: $hall_name 
          },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (data) {
            $h = `<li class="hallDeleteList">${data.hall_name}
                    <button class="conf-step__button conf-step__button-trash" type="button" id="{{ $hall_name }}" data-delHall-id=${data.hall_id}"></button>
                  </li>`
            $('.conf-step__list').append($h);
            addModal.classList.toggle('active');
          }
        });
      });
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

// Поля ввода кол-ва рядов и мест в ряду
const inputRowsCount = document.getElementById('input_rows_count');
const inputPlacesCount = document.getElementById('input_places_count');

//Показать экран зала
for (let i = 0; i<chairsHallConfInput.length; i++) {
  chairsHallConfInput[i].addEventListener('click', function() {
    hallsSeats.forEach(tab => {
        tab.style.display = 'none'
      })
    hallsSeats[i].style.display = "block";
      var chairRow = [...hallsSeats[i].querySelectorAll('.conf-step__row')];
      inputRowsCount.value = chairRow.length
      var col = [...chairRow[0].querySelectorAll('.conf-step__chair')];
    inputPlacesCount.value = col.length;
  })
}

// Обновление категории места и колличества рядов в зале
$(document).ready(function () {
  $('#hallConfSaveBtn').click(function(e) {
    if (inputRowsCount.value > 20) {inputRowsCount.value = "20"};
    if (inputPlacesCount.value > 20) {inputPlacesCount.value = "20"};
    const rows = Number(inputRowsCount.value);
    
    const places = Number(inputPlacesCount.value);

    const hallConf = {
      'rows': rows,
      'cols': places
    }

    let result = [];

    hallsSeats.forEach(tab => {
      if (tab.style.display === 'block') {
        var allHallChair = [...tab.querySelectorAll('.conf-step__chair')];
        var chairRow = [...tab.querySelectorAll('.conf-step__row')];
        var col = [...chairRow[0].querySelectorAll('.conf-step__chair')];
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
        
        $.ajax({
          url: "/hall_chair",
          type: 'GET',
          data: {
          result: result,
          hallConf: hallConf
          },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success(data) {
          }
        });
      }
    })
                
  })
})

//Конфигурация цен
  chairsPrice.forEach(hall => hall.addEventListener('click', function() {
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

       $('#savePrice').click(function () {
      $.ajax({
          url: "/save_price",
          type: 'POST',
          data: {
            result: [
              {
                'hall_id': hall.value,
                'status': 'standart',
                'price': standartPriceInput.value,
              },
              {
                'hall_id': hall.value,
                'status': 'vip',
                'price': vipPriceInput.value
              }
            ]
          },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        success: function (data) {
          location.reload();
          }
        });
      })
  }))

// Переключение типов кресел
const chairChecked = () => {
  const chairs = Array.from(document.querySelectorAll('.conf-step__row  .conf-step__chair'));
  chairs.forEach(chair => chair.addEventListener('click', () => {
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


//Добавить фильм 
$(document).ready(function() {
  $('#addMivieForm').submit(function(e) {
    let movieName = $('#addMovieInput').val();
    let movieDur = $('#addMovieDurationInput').val()
    e.preventDefault();

    $.ajax({
      url: "/add_movie",
      type: 'POST',
      data: {
      title: movieName,
      duration: movieDur
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (data) {
        console.log(data);
        // location.reload();
      }
    });
  });
})


//Schedules-add-Popup
showtimeAdd.forEach(movie => {
  movie.addEventListener('click', () => {
    let title = movie.querySelector('.conf-step__movie-title')
    addShowtimeModal.classList.toggle('active');
    movieNameInput.value = title.textContent
  })
})


//Добавить фильм в расписание
$(document).ready(function() {
  $('#seanceAddForm').submit(function(e) {
    let movieName = $('#seance_movieName').val();
    let hallId = $('#seance_hallName option:selected').val();
    let startTime = $('#seance_startTime').val();

     e.preventDefault();

    $.ajax({
      url: "/add_movie_schedule",
      type: 'POST',
      data: {
        hall_id: hallId,
        movie_name: movieName,
        start_time: startTime,
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function () {
        location.reload();
      }
    });
  });
})


//Закрыть Popup сеанса
showtimeDismiss.addEventListener('click', function(e) {
  e.preventDefault();
  addShowtimeModal.classList.toggle('active');
})

//Удаление фильма
$(document).ready(function() {
  $('#movie_delete_btn').click(function(e) {
    let movieName = $('#seance_movieName').val();

    $.ajax({
      url: "{{route('filmDelete')}}",
      type: 'POST',
      data: {
        title: movieName,
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        location.reload();
      }
    });
  });
})

//Schedule-delete-Popup
scheduleMovieItems.forEach(movie => {
  movie.addEventListener('click', () => {
    delSheduleMovie.classList.toggle('active');
    let movieName = movie.querySelector('.conf-step__seances-movie-title').textContent;
    let movieTime = movie.querySelector('.conf-step__seances-movie-start').textContent;
    let id = movie.getAttribute('data-hallSchedule-id');
    popupMovieSpan.textContent = movieName;

    $('#delete_hall_shedule').submit(function () {
      $.ajax({
          url: "/delete_hall_shedule",
          type: 'POST',
          data: {
            movieName: movieName,
            movieTime: movieTime,
            hall_id: id
          },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        success: function (data) {
          location.reload();
          }
        });
      })
  })
})
delShowtimeDismiss.addEventListener('click', function(e) {
  e.preventDefault();
  delSheduleMovie.classList.toggle('active');
})
//Delete-Popup show


//start of sales
  startOfSalesRadio.forEach(radio => {
    radio.addEventListener('click', () => {
      if (radio.classList.contains("is_active")) {
        openHallParagraf.textContent = 'Зал готов к открытию:';
        openHallParagraf.style.color = 'rgb(0,136,0)';
        startOfSalesBtn.removeAttribute('disabled');
        
      }
      if(!radio.classList.contains("is_active")) {
        startOfSalesBtn.setAttribute('disabled', true);
        openHallParagraf.textContent = 'Нет сеансов';
        openHallParagraf.style.color = 'rgb(255,0,0)';
      }
      if (radio.getAttribute('data-active') == 1) {
        openHallParagraf.textContent = 'Продажа билетов открыта:';
        startOfSalesBtn.textContent = "Закрыть продажу билетов"
      }
      else if (radio.getAttribute('data-active') == 0) {
        startOfSalesBtn.textContent = "Открыть продажу билетов"
      }
    })
    $(document).ready(function () {
  $('#startOfSalesBtn').click(function (e) {
    if (radio.checked) {
      let hallId = $(radio).val();

      $.ajax({
          url: "/start_of_sales",
          type: 'POST',
          data: {
            id: hallId
          },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        success: function (data) {
          startOfSalesBtn.textContent = data[0];
          openHallParagraf.textContent = data[1];
          }
        });
        }
      })
    })
})



