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
      standartPriceInput.value = data.find(el => el.status === 'standart').price
      vipPriceInput.value = data.find(el => el.status === 'vip').price
    }
    else {
      $.ajax({
        url: "/save_price",
        type: 'POST',
        data: {
          result: [
            {
              'hall_id': hall.value,
              'status': 'standart',
              'price': 100,
            },
            {
              'hall_id': hall.value,
              'status': 'vip',
              'price': 200,
            }
          ]
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
      success: function (data) {
        standartPriceInput.value = 100
        vipPriceInput.value = 200
        }, 
      });
      
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
        }, 
      });
    }
  })
}))