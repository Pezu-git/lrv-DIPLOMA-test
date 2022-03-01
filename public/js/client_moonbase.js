/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/client/js/choosingPlace.js ***!
  \**********************************************/
//Переключение типов кресел
var chairChecked = function chairChecked() {
  var chairs = Array.from(document.querySelectorAll('.buying-scheme__row  .buying-scheme__chair'));
  chairs.forEach(function (chair) {
    return chair.addEventListener('click', function () {
      if (chair.classList.contains('buying-scheme__chair_standart')) {
        // chair.classList.toggle('buying-scheme__chair_standart');
        chair.classList.toggle('buying-scheme__chair_selected');
      } else if (chair.classList.contains('buying-scheme__chair_vip')) {
        // chair.classList.toggle('buying-scheme__chair_vip');
        chair.classList.toggle('buying-scheme__chair_selected');
      }
    });
  });
};

chairChecked();
/******/ })()
;