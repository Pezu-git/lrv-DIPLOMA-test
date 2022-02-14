let startOfSalesRadio = [...document.getElementsByName("startOfSales-hall")];
let openHallParagraf = document.querySelector('.open-hall');
let startOfSalesBtn = document.querySelector('.startOfSalesBtn');

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