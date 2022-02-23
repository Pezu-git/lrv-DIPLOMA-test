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
$movie_title = $_GET['movie_title'];
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
try{
return $m->seats->where('row_num', $i)->where('seat_num', $l)->first()->status;
}
catch(Exception $e) {
return 'standart';
}
}
function hallWhithSchedule($hall) {
if(MovieSchedule::where('hall_id', $hall->id)->first()) {
return 'is_active';
}
else {
return null;
}
}

function activeHall($hall) {
if(Hall::where('id', $hall->id)->first()->is_active) {
return 1;
}
else {
return 0;
}
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
    <section class="ticket">

      <header class="tichet__check">
        <h2 class="ticket__check-title">Вы выбрали билеты:</h2>
      </header>

      <div class="ticket__info-wrapper">
        <p class="ticket__info">На фильм: <span class="ticket__details ticket__title">{{$movie_title}}</span></p>
        <p class="ticket__info">Ряд/Место: <span class="ticket__details ticket__chairs">6/7</span></p>
        <p class="ticket__info">Зал: <span class="ticket__details ticket__hall">{{$hall_name}}</span></p>
        <p class="ticket__info">Начало сеанса: <span class="ticket__details ticket__start">{{$start_time}}</span></p>
        <p class="ticket__info">Стоимость: <span class="ticket__details ticket__cost">600</span> рублей</p>


        <button class="acceptin-button" onclick="location.href=`{{route('ticket')}}`">Получить код бронирования</button>

        <p class="ticket__hint">После оплаты билет будет доступен в этом окне, а также придёт вам на почту. Покажите QR-код нашему контроллёру у входа в зал.</p>
        <p class="ticket__hint">Приятного просмотра!</p>
      </div>
    </section>
  </main>

</body>



</html>