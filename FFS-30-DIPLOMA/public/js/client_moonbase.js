/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/client/js/choosingPlace.js ***!
  \**********************************************/
//Выбор места
var chairChecked = function chairChecked() {
  var chairs = Array.from(document.querySelectorAll('.buying-scheme__row  .buying-scheme__chair'));
  chairs.forEach(function (chair) {
    return chair.addEventListener('click', function () {
      if (chair.classList.contains('buying-scheme__chair_taken')) {
        return;
      }

      chair.classList.toggle('buying-scheme__chair_selected');
    });
  });
};

chairChecked(); //Обновление зала бронирования

var buttonAcceptin = document.querySelector('.acceptin-button');
var hallName = document.querySelector('.buying__info-hall').textContent;
var seance = document.querySelector('.buying__info-start').textContent.substring(15);
var title = document.querySelector('.buying__info-title').textContent; // Вешаем событие onclick на кнопку

buttonAcceptin.addEventListener("click", function (event) {
  var chairsSelected = Array.from(document.querySelectorAll('.buying-scheme__row .buying-scheme__chair_selected'));
  event.preventDefault(); // Формируем список выбранных мест

  var selectedPlaces = Array();
  var divRows = Array.from(document.getElementsByClassName("buying-scheme__row"));

  for (var i = 0; i < divRows.length; i++) {
    var spanPlaces = Array.from(divRows[i].getElementsByClassName("buying-scheme__chair"));

    for (var j = 0; j < spanPlaces.length; j++) {
      if (spanPlaces[j].classList.contains("buying-scheme__chair_selected")) {
        // Определяем тип выбранного кресла
        var typePlace = spanPlaces[j].classList.contains("buying-scheme__chair_standart") ? "standart" : "vip";
        selectedPlaces.push({
          "row": i + 1,
          "place": j + 1,
          "type": typePlace
        });
      }
    }
  }

  chairsSelected.forEach(function (chair) {
    if (chair.classList.contains("buying-scheme__chair_vip")) {
      chair.classList.toggle("buying-scheme__chair_vip");
    }

    chair.classList.toggle("buying-scheme__chair_selected");
    chair.classList.toggle("buying-scheme__chair_taken");
  });
  $.ajax({
    url: "/client_hall",
    type: 'GET',
    data: {
      movie: title,
      hallName: hallName,
      seance: seance,
      takenPlaces: selectedPlaces
    },
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function success(data) {
      location.href = data;
    }
  });
});
/******/ })()
;