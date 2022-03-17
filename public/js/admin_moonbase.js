/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
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
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!*****************************************!*\
  !*** ./resources/admin/js/hallPrice.js ***!
  \*****************************************/
var chairsPrice = Array.from(document.getElementsByName("prices-hall"));
var standartPriceInput = document.getElementById('standartPrice');
var vipPriceInput = document.getElementById('vipPrice'); //Конфигурация цен

chairsPrice.forEach(function (hall) {
  return hall.addEventListener('click', function (e) {
    $.ajax({
      url: "/show_price",
      type: 'GET',
      data: {
        hall_id: hall.value
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function success(data) {
        if (data) {
          standartPriceInput.placeholder = data[0].price;
          vipPriceInput.placeholder = data[1].price;
        } else {
          standartPriceInput.placeholder = 0;
          vipPriceInput.placeholder = 0;
        }
      }
    });
    $('#savePrice').click(function () {
      if (hall.checked) {
        $.ajax({
          url: "/save_price",
          type: 'POST',
          data: {
            result: [{
              'hall_id': hall.value,
              'status': 'standart',
              'price': standartPriceInput.value
            }, {
              'hall_id': hall.value,
              'status': 'vip',
              'price': vipPriceInput.value
            }]
          },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function success(data) {
            location.reload();
            if (data) {
              alert(data);
            }
          }
        });
      }
    });
  });
});
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!*************************************!*\
  !*** ./resources/admin/js/halls.js ***!
  \*************************************/
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

var trashs = Array.from(document.querySelectorAll('[data-delHall-id]'));
var delModal = document.getElementById('deletePopup');
var deleteDismiss = document.getElementById('delModalDissmis');
var hallAddPopupShowBtn = document.getElementById('hallAddPopupShow');
var addModal = document.getElementById('addPopup');
var addDismiss = document.getElementById('addModalDissmis');

var ul = _toConsumableArray(document.querySelectorAll('.hallDeleteList'));

var popupSpan = document.querySelector('.popupHallName'); //Delete-Popup close

deleteDismiss.addEventListener('click', function (e) {
  e.preventDefault();
  delModal.classList.toggle('active');
}); //Add-Popup show

hallAddPopupShowBtn.addEventListener('click', function () {
  addModal.classList.toggle('active');
}); //Add-Popup close

addDismiss.addEventListener('click', function (e) {
  e.preventDefault();
  addModal.classList.toggle('active');
}); //Удаление зала

var _loop = function _loop(i) {
  trashs[i].addEventListener('click', function () {
    delModal.classList.toggle('active');
    var id = trashs[i].getAttribute('data-delHall-id');
    console.log(ul[i].textContent);
    popupSpan.textContent = ul[i].textContent;
    $(document).ready(function () {
      $('#hallDeleteForm').submit(function (e) {
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
          success: function success(data) {
            location.reload();
          }
        });
      });
    });
  });
};

for (var i = 0; i < trashs.length; i++) {
  _loop(i);
} //Добавление зала


$(document).ready(function () {
  $('#hallAddForm').submit(function (e) {
    e.preventDefault();
    $hall_name = $('#hallNameAdd').val();
    $.ajax({
      url: "/hall_add",
      type: 'POST',
      data: {
        name: $hall_name
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function success(data) {
        $.ajax({
          url: "/hall_conf",
          type: 'POST',
          data: {
            hall_id: data.hall_id
          },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function success() {}
        }); // $h = `<li class="hallDeleteList">${data.hall_name}
        //         <button class="conf-step__button conf-step__button-trash" type="button" id="{{ $hall_name }}" data-delHall-id=${data.hall_id}"></button>
        //       </li>`
        // $('.conf-step__list').append($h);
        // addModal.classList.toggle('active');

        location.reload();
      }
    });
  });
});
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!******************************************!*\
  !*** ./resources/admin/js/hallScreen.js ***!
  \******************************************/
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

// Поля ввода кол-ва рядов и мест в ряду
var inputRowsCount = document.getElementById('input_rows_count');
var inputPlacesCount = document.getElementById('input_places_count');
var chairsHallConfInput = document.getElementsByName("chairs-hall");
var hallsSeats = Array.from(document.querySelectorAll('.conf-step__hall'));

var hallConfRadio = _toConsumableArray(document.querySelectorAll('.conf-step__radio.hide'));

var hallWrapper = _toConsumableArray(document.querySelectorAll('.conf-step__hall-wrapper')); //Переключение типов кресел


var chairChecked = function chairChecked() {
  var chairs = Array.from(document.querySelectorAll('.conf-step__row  .conf-step__chair'));
  chairs.forEach(function (chair) {
    return chair.addEventListener('click', function () {
      if (chair.classList.contains('conf-step__chair_standart')) {
        chair.classList.toggle('conf-step__chair_standart');
        chair.classList.toggle('conf-step__chair_vip');
      } else if (chair.classList.contains('conf-step__chair_vip')) {
        chair.classList.toggle('conf-step__chair_vip');
        chair.classList.toggle('conf-step__chair_disabled');
      } else if (chair.classList.contains('conf-step__chair_disabled')) {
        chair.classList.toggle('conf-step__chair_disabled');
        chair.classList.toggle('conf-step__chair_standart');
      }

      ;
    });
  });
}; //Показать экран зала


var _loop = function _loop(i) {
  chairsHallConfInput[i].addEventListener('click', function () {
    hallsSeats.forEach(function (tab) {
      tab.style.display = 'none';
    });
    hallsSeats[i].style.display = "block";

    var chairRow = _toConsumableArray(hallsSeats[i].querySelectorAll('.conf-step__row'));

    inputRowsCount.value = chairRow.length;

    var col = _toConsumableArray(chairRow[0].querySelectorAll('.conf-step__chair'));

    inputPlacesCount.value = col.length; //Перерисовка зала при вводе в input кол-ва рядов

    inputRowsCount.oninput = function () {
      if (inputRowsCount.value > 20) {
        inputRowsCount.value = 20;
      }

      ;
      hallWrapper[i].innerHTML = '';

      for (var k = 0; k < Number(inputRowsCount.value); k++) {
        hallWrapper[i].insertAdjacentHTML('afterBegin', "\n             <div class=\"conf-step__row\">\n          </div>\n         ");
      }

      var hallRows = _toConsumableArray(hallWrapper[i].querySelectorAll('.conf-step__row'));

      hallRows.forEach(function (element) {
        for (var j = 0; j < Number(inputPlacesCount.value); j++) {
          element.insertAdjacentHTML('afterBegin', "<span class=\"conf-step__chair conf-step__chair_standart\"></span>");
        }
      });
      chairChecked();
    }; //Перерисовка зала при вводе в input кол-ва мест в ряду


    inputPlacesCount.oninput = function () {
      if (inputPlacesCount.value > 20) {
        inputPlacesCount.value = 20;
      }

      ;
      hallWrapper[i].innerHTML = '';

      for (var k = 0; k < Number(inputRowsCount.value); k++) {
        hallWrapper[i].insertAdjacentHTML('afterBegin', "\n           <div class=\"conf-step__row\">\n        </div>\n       ");
      }

      var hallRows = _toConsumableArray(hallWrapper[i].querySelectorAll('.conf-step__row'));

      hallRows.forEach(function (element) {
        for (var j = 0; j < Number(inputPlacesCount.value); j++) {
          element.insertAdjacentHTML('afterBegin', "<span class=\"conf-step__chair conf-step__chair_standart\"></span>");
        }
      });
      chairChecked();
    };
  });
};

for (var i = 0; i < chairsHallConfInput.length; i++) {
  _loop(i);
} // Обновление категории места и колличества рядов в зале


$(document).ready(function () {
  $('#hallConfSaveBtn').click(function (e) {
    var rows = Number(inputRowsCount.value);
    var places = Number(inputPlacesCount.value);
    var hallConf = {
      'rows': rows,
      'cols': places
    };
    var result = [];
    hallsSeats.forEach(function (tab) {
      if (tab.style.display === 'block') {
        var allHallChair = _toConsumableArray(tab.querySelectorAll('.conf-step__chair'));

        var chairRow = _toConsumableArray(tab.querySelectorAll('.conf-step__row'));

        var col = _toConsumableArray(chairRow[0].querySelectorAll('.conf-step__chair'));

        hallConfRadio.forEach(function (radio) {
          if (radio.checked) {
            for (var _i = 0; _i < chairRow.length; _i++) {
              for (var j = 0; j < col.length; j++) {
                result.push({
                  'hall_id': radio.value,
                  'row_num': _i,
                  'seat_num': j,
                  'status': 'standart'
                });
              }
            }

            for (var k = 0; k < allHallChair.length; k++) {
              result[k].status = allHallChair[k].className.slice(34);
            }
          }
        });
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
          success: function success(data) {
            console.log(data);
          }
        });
      }
    });
  });
});
chairChecked();
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!*************************************!*\
  !*** ./resources/admin/js/movie.js ***!
  \*************************************/
var addMovieBtn = document.getElementById('addMovie');
var addMovieModal = document.getElementById('addMoviePopup');
var movieDismiss = document.getElementById('movieModalDissmis'); //Movie-Popup show

addMovieBtn.addEventListener('click', function () {
  addMovieModal.classList.toggle('active');
}); //Movie-Popup close

movieDismiss.addEventListener('click', function (e) {
  e.preventDefault();
  addMovieModal.classList.toggle('active');
}); //Добавить фильм 

$(document).ready(function () {
  $('#addMovieForm').submit(function (e) {
    var movieName = $('#addMovieInput').val();
    var movieDur = $('#addMovieDurationInput').val();
    var movieDesc = $('#addMovieTextarea').val();
    var movieCountry = $('#addMovieCountryInput').val();
    e.preventDefault();
    $.ajax({
      url: "/add_movie",
      type: 'POST',
      data: {
        title: movieName,
        duration: movieDur,
        description: movieDesc,
        country: movieCountry
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function success() {
        location.reload();
      }
    });
  });
}); //Удаление фильма

$(document).ready(function () {
  $('#movie_delete_btn').click(function () {
    var movieName = $('#seance_movieName').val();
    $.ajax({
      url: "/delete_movie",
      type: 'POST',
      data: {
        title: movieName
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function success() {
        location.reload();
      }
    });
  });
});
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!**********************************************!*\
  !*** ./resources/admin/js/popupCancelBtn.js ***!
  \**********************************************/
var cancelBtn = Array.from(document.querySelectorAll('.conf-step__button-regular')); //Кнопка ОТМЕНА

for (var i = 0; i < cancelBtn.length; i++) {
  cancelBtn[i].addEventListener('click', function (e) {
    e.preventDefault();
    location.reload(true);
  });
}
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!********************************************!*\
  !*** ./resources/admin/js/startOfSales.js ***!
  \********************************************/
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

var startOfSalesRadio = _toConsumableArray(document.getElementsByName("startOfSales-hall"));

var openHallParagraf = document.querySelector('.open-hall');
var startOfSalesBtn = document.querySelector('.startOfSalesBtn'); //start of sales

startOfSalesRadio.forEach(function (radio) {
  radio.addEventListener('click', function () {
    if (radio.classList.contains("is_active")) {
      openHallParagraf.textContent = 'Зал готов к открытию:';
      openHallParagraf.style.color = 'rgb(0,136,0)';
      startOfSalesBtn.removeAttribute('disabled');
    }

    if (!radio.classList.contains("is_active")) {
      startOfSalesBtn.setAttribute('disabled', true);
      openHallParagraf.textContent = 'Нет сеансов';
      openHallParagraf.style.color = 'rgb(255,0,0)';
    }

    if (radio.getAttribute('data-active') == 1) {
      openHallParagraf.textContent = 'Продажа билетов открыта:';
      startOfSalesBtn.textContent = "Закрыть продажу билетов";
    } else if (radio.getAttribute('data-active') == 0) {
      startOfSalesBtn.textContent = "Открыть продажу билетов";
    }
  });
  $(document).ready(function () {
    $('#startOfSalesBtn').click(function (e) {
      if (radio.checked) {
        var hallId = $(radio).val();
        $.ajax({
          url: "/start_of_sales",
          type: 'POST',
          data: {
            id: hallId
          },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function success(data) {
            startOfSalesBtn.textContent = data[0];
            openHallParagraf.textContent = data[1];
          }
        });
      }
    });
  });
});
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!****************************************!*\
  !*** ./resources/admin/js/schedule.js ***!
  \****************************************/
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

var scheduleMovieItems = _toConsumableArray(document.querySelectorAll('.conf-step__seances-movie'));

var delSheduleMovie = document.getElementById('delShowtimePopup');
var popupMovieSpan = document.querySelector('.popupMovieName');
var delShowtimeDismiss = document.getElementById('delShowtimeModalDissmis');
var showtimeDismiss = document.getElementById('showtimeModalDissmis');

var showtimeAdd = _toConsumableArray(document.querySelectorAll('.conf-step__movie'));

var addShowtimeModal = document.getElementById('addShowtimePopup');
var movieNameInput = document.querySelector('.movie_name'); //Schedule-delete-Popup

scheduleMovieItems.forEach(function (movie) {
  movie.addEventListener('click', function () {
    delSheduleMovie.classList.toggle('active');
    var movieName = movie.querySelector('.conf-step__seances-movie-title').textContent;
    var movieTime = movie.querySelector('.conf-step__seances-movie-start').textContent;
    var id = movie.getAttribute('data-hallSchedule-id');
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
        success: function success() {
          location.reload();
        }
      });
    });
  });
});
delShowtimeDismiss.addEventListener('click', function (e) {
  e.preventDefault();
  delSheduleMovie.classList.toggle('active');
}); //Schedules-add-Popup

showtimeAdd.forEach(function (movie) {
  movie.addEventListener('click', function () {
    console.log(movie);
    var title = movie.querySelector('.conf-step__movie-title');
    addShowtimeModal.classList.toggle('active');
    movieNameInput.value = title.textContent;
  });
}); //Закрыть Popup сеанса

showtimeDismiss.addEventListener('click', function (e) {
  e.preventDefault();
  addShowtimeModal.classList.toggle('active');
}); // Добавить фильм в расписание

$(document).ready(function () {
  $('#seanceAddForm').submit(function (e) {
    var movieName = $('#seance_movieName').val();
    var hallId = $('#seance_hallName option:selected').val();
    var startTime = $('#seance_startTime').val(); // e.preventDefault()

    $.ajax({
      url: "/add_movie_schedule",
      type: 'POST',
      data: {
        hall_id: hallId,
        movie_name: movieName,
        start_time: startTime
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function success(data) {
        location.reload();

        if (data) {
          alert(data);
        }
      }
    });
  });
});
})();

/******/ })()
;