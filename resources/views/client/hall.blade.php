@php

use App\Models\Movie;
use App\Models\Hall;
use App\Models\Seat;
use App\Models\HallConf;
use App\Models\MovieSchedule;
use App\Models\PriceList;

$movies = Movie::all();
$halls = Hall::all();
$hallConf = HallConf::all();


$hall_name = $_GET['hall_name'];
$hall = $halls->where('name', $hall_name)->first();
$movie_title = $_GET['movie'];
$start_time = $_GET['start_time'];


$hall_price_standart = PriceList::where('hall_id', $hall->id)->where('status', 'standart')->first()->price;
$hall_price_vip = PriceList::where('hall_id', $hall->id)->where('status', 'vip')->first()->price;



function hallConfRow($hall) {
return (int)HallConf::where('id', $hall->id)->first()->rows;
}
function hallConfCol($hall) {
return HallConf::where('id', $hall->id)->first()->cols;
}


function hallSeats($m, $i, $l) {
$start_time = $_GET['start_time'];
$seance_id = MovieSchedule::where('hall_id', $m->id)->where('start_time', $start_time)->first()->id;
if($m->takenSeats->where('hall_id', $m->id)->where('seance_id', $seance_id)->where('row_num', $i)->where('seat_num', $l)->first()->taken) {
return 'taken';
}
return $m->seats->where('row_num', $i)->where('seat_num', $l)->first()->status;
}


@endphp


<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ИдёмВКино</title>
  <link rel="stylesheet" href="css/client_normolize_moonbase.css">
  <link rel="stylesheet" href="css/client_moonbase.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
</head>

<body>
  <header class="page-header">
    <h1 class="page-header__title">Идём<span>в</span>кино</h1>
  </header>

  <main>
    <section class="buying">
      <div class="buying__info">
        <div class="buying__info-description">
          <h2 class="buying__info-title">{{$movie_title}}</h2>
          <p class="buying__info-start">Начало сеанса: {{$start_time}}</p>
          <p class="buying__info-hall">{{$hall_name}}</p>
        </div>
        <div class="buying__info-hint">
          <p>Тапните дважды,<br>чтобы увеличить</p>
        </div>
      </div>
      <div class="buying-scheme">
        <div class="buying-scheme__wrapper">
          @for($j = 0; $j < hallConfRow($hall); $j++) <div class="buying-scheme__row">
            @for($k = 0; $k < hallConfCol($hall); $k++) <span class="buying-scheme__chair buying-scheme__chair_{{hallSeats($hall, $j, $k)}}"></span>
              @endfor
        </div>
        @endfor
      </div>


      <div class="buying-scheme__legend">
        <div class="col">
          <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_standart"></span> Свободно (<span class="buying-scheme__legend-value">{{$hall_price_standart}}</span>руб)</p>
          <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_vip"></span> Свободно VIP (<span class="buying-scheme__legend-value">{{$hall_price_vip}}</span>руб)</p>
        </div>
        <div class="col">
          <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_taken"></span> Занято</p>
          <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_selected"></span> Выбрано</p>
        </div>
      </div>
      </div>
      <button class="acceptin-button">Забронировать</button>
    </section>
  </main>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script>
  const chairChecked = () => {
    const chairs = Array.from(document.querySelectorAll('.buying-scheme__row  .buying-scheme__chair'));
    chairs.forEach(chair => chair.addEventListener('click', () => {
      if (chair.classList.contains('buying-scheme__chair_taken')) {
        return;
      }
      chair.classList.toggle('buying-scheme__chair_selected');

    }));
  }
  chairChecked();


  const buttonAcceptin = document.querySelector('.acceptin-button');
  const hallName = document.querySelector('.buying__info-hall').textContent;
  const seance = document.querySelector('.buying__info-start').textContent.substring(15);
  const title = document.querySelector('.buying__info-title').textContent;

  // Вешаем событие onclick на кнопку
  buttonAcceptin.addEventListener("click", (event) => {
    let chairsSelected = Array.from(document.querySelectorAll('.buying-scheme__row .buying-scheme__chair_selected'));
    event.preventDefault();
    // Формируем список выбранных мест
    const selectedPlaces = Array();
    const divRows = Array.from(document.getElementsByClassName("buying-scheme__row"));
    for (let i = 0; i < divRows.length; i++) {
      const spanPlaces = Array.from(divRows[i].getElementsByClassName("buying-scheme__chair"));
      for (let j = 0; j < spanPlaces.length; j++) {
        if (spanPlaces[j].classList.contains("buying-scheme__chair_selected")) {
          // Определяем тип выбранного кресла
          const typePlace = (spanPlaces[j].classList.contains("buying-scheme__chair_standart")) ? "standart" : "vip"
          selectedPlaces.push({
            "row": i + 1,
            "place": j + 1,
            "type": typePlace
          })
        }
      }
    }
    chairsSelected.forEach(chair => {
      if (chair.classList.contains("buying-scheme__chair_vip")) {
        chair.classList.toggle("buying-scheme__chair_vip");
      }
      chair.classList.toggle("buying-scheme__chair_selected");
      chair.classList.toggle("buying-scheme__chair_taken");

    })
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
      success: function(data) {
        location.href = data;
      }
    });
  });
</script>

</html>