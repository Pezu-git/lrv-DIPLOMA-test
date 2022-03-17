let chairsPrice = Array.from(document.getElementsByName("prices-hall"));
let standartPriceInput = document.getElementById('standartPrice');
let vipPriceInput = document.getElementById('vipPrice');


//Конфигурация цен
chairsPrice.forEach(hall => hall.addEventListener('click', function(e) {
  standartPriceInput.value = '';
  vipPriceInput.value = '';
  $.ajax({
    url: "/show_price",
    type: 'GET',
    data: {
      hall_id: hall.value
    },
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
  success: function (data) {
    if(data) {
      standartPriceInput.placeholder = data[0].price
      vipPriceInput.placeholder = data[1].price
    }
    else {
      standartPriceInput.placeholder = 0
      vipPriceInput.placeholder = 0
    }
    }
  });

  $('#savePrice').click(function () {
    if(hall.checked) {
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
        if(data) {
          alert(data)
        }
        }, 
      });
    }
  })
}))