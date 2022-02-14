let chairsPrice = Array.from(document.getElementsByName("prices-hall"));
let standartPriceInput = document.getElementById('standartPrice');
let vipPriceInput = document.getElementById('vipPrice');


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