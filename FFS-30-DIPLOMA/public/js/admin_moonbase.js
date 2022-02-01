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
var accent = document.querySelector('button.conf-step__button-accent');
var delModal = document.getElementById('deletePopup');
var addModal = document.getElementById('addPopup');
var deleteDismiss = document.getElementById('delModalDissmis');
var addDismiss = document.getElementById('addModalDissmis');
var addHallInput = document.getElementsByName('name');
var addHallButton = document.getElementsByName('addHall');


var ul = Array.from(document.querySelectorAll('.hallDeleteList'));
var popupSpan = document.querySelector('.popupHallName');
var myForm = document.getElementById("deleteForm");
var addForm = document.getElementsByName('hallAddForm');

//Delete-Popup show
for (let i = 0; i < trashs.length; i++) {
  trashs[i].addEventListener('click', function() {
    delModal.classList.toggle('active');
    popupSpan.textContent = ul[i].textContent;
    myForm.action = `/admin/delete_hall/${trashs[i].id}`
  })
}
//Delete-Popup close
deleteDismiss.addEventListener('click', function() {
  delModal.classList.toggle('active');
})
//Add-Popup show
accent.addEventListener('click', function() {
  addModal.classList.toggle('active');
})
//Add-Popup close
addDismiss.addEventListener('click', function() {
  addModal.classList.toggle('active');
})

