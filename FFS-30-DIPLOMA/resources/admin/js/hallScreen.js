// Поля ввода кол-ва рядов и мест в ряду
const inputRowsCount = document.getElementById('input_rows_count');
const inputPlacesCount = document.getElementById('input_places_count');

let chairsHallConfInput = document.getElementsByName("chairs-hall");
let hallsSeats = Array.from(document.querySelectorAll('.conf-step__hall'));
let hallConfRadio = [...document.querySelectorAll('.conf-step__radio.hide')];
let hallWrapper = [...document.querySelectorAll('.conf-step__hall-wrapper')];

//Переключение типов кресел
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

//Показать экран зала
for (let i = 0; i<chairsHallConfInput.length; i++) {
  chairsHallConfInput[i].addEventListener('click', function() {
    hallsSeats.forEach(tab => {
        tab.style.display = 'none'
      })
    hallsSeats[i].style.display = "block";
      let chairRow = [...hallsSeats[i].querySelectorAll('.conf-step__row')];
      inputRowsCount.value = chairRow.length
      let col = [...chairRow[0].querySelectorAll('.conf-step__chair')];
    inputPlacesCount.value = col.length;
  
//Перерисовка зала при вводе в input кол-ва рядов
    inputRowsCount.oninput = function() {
      if (inputRowsCount.value > 15) {inputRowsCount.value = 15};
      hallWrapper[i].innerHTML = ''
      for(let k = 0; k < Number(inputRowsCount.value); k++) {
        hallWrapper[i].insertAdjacentHTML('afterBegin', `
             <div class="conf-step__row">
          </div>
         `)
      }
      let hallRows = [...hallWrapper[i].querySelectorAll('.conf-step__row')]
      hallRows.forEach(element => {
        for(let j = 0; j < Number(inputPlacesCount.value); j++) {
          element.insertAdjacentHTML('afterBegin', `<span class="conf-step__chair conf-step__chair_standart"></span>`)
        }
      });
      chairChecked();
    };
    //Перерисовка зала при вводе в input кол-ва мест в ряду
    inputPlacesCount.oninput = function() {
    if (inputPlacesCount.value > 15) {inputPlacesCount.value = 15};
    hallWrapper[i].innerHTML = ''
    for(let k = 0; k < Number(inputRowsCount.value); k++) {
      hallWrapper[i].insertAdjacentHTML('afterBegin', `
           <div class="conf-step__row">
        </div>
       `)
    }
    let hallRows = [...hallWrapper[i].querySelectorAll('.conf-step__row')]
    hallRows.forEach(element => {
      for(let j = 0; j < Number(inputPlacesCount.value); j++) {
        element.insertAdjacentHTML('afterBegin', `<span class="conf-step__chair conf-step__chair_standart"></span>`)
      }
    });
    chairChecked();
    };
  })
}


// Обновление категории места и колличества рядов в зале
$(document).ready(function () {
  $('#hallConfSaveBtn').click(function(e) {
    const rows = Number(inputRowsCount.value);
    const places = Number(inputPlacesCount.value);
    const hallConf = {
      'rows': rows,
      'cols': places
    }
    let result = [];

    hallsSeats.forEach(tab => {
      if (tab.style.display === 'block') {
        let allHallChair = [...tab.querySelectorAll('.conf-step__chair')];
        let chairRow = [...tab.querySelectorAll('.conf-step__row')];
        let col = [...chairRow[0].querySelectorAll('.conf-step__chair')];
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
          type: 'POST',
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
chairChecked();