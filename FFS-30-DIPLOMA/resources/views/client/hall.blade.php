@php

use App\Models\Movie;
use App\Models\Hall;
use App\Models\Seat;
use App\Models\HallConf;
use App\Models\MovieSchedule;

$movies = Movie::all();

function movieTit($m) {
return Movie::where('id', $m->movie_id)->first()->title;
}
function movieDuration($m) {
return (int)(Movie::where('id', $m->movie_id)->first()->duration)/2;
}
function movieStyleLeft($m) {
return (int)($m->start_time)*30;
}

$hallConf = HallConf::all();

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
    <section class="buying">
      <div class="buying__info">
        <div class="buying__info-description">
          <h2 class="buying__info-title">Звёздные войны XXIII: Атака клонированных клонов</h2>
          <p class="buying__info-start">Начало сеанса: 18:30</p>
          <p class="buying__info-hall">Зал 1</p>          
        </div>
        <div class="buying__info-hint">
          <p>Тапните дважды,<br>чтобы увеличить</p>
        </div>
      </div>
      <div class="buying-scheme">
        <div class="buying-scheme__wrapper">
          <div class="buying-scheme__row">
            <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
            <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
              <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
              <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
            <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
            </div>  

            <div class="buying-scheme__row">
              <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
              <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
              <span class="buying-scheme__chair buying-scheme__chair_taken"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
              <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
              <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
            </div>  

            <div class="buying-scheme__row">
              <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
              <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
            </div>  

            <div class="buying-scheme__row">
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_vip"></span>
              <span class="buying-scheme__chair buying-scheme__chair_vip"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
              <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
            </div>  

            <div class="buying-scheme__row">
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
              <span class="buying-scheme__chair buying-scheme__chair_vip"></span><span class="buying-scheme__chair buying-scheme__chair_vip"></span>
              <span class="buying-scheme__chair buying-scheme__chair_vip"></span><span class="buying-scheme__chair buying-scheme__chair_vip"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
              <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
            </div>  

            <div class="buying-scheme__row">
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
              <span class="buying-scheme__chair buying-scheme__chair_vip"></span><span class="buying-scheme__chair buying-scheme__chair_taken"></span>
              <span class="buying-scheme__chair buying-scheme__chair_taken"></span><span class="buying-scheme__chair buying-scheme__chair_taken"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
              <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
            </div>  

            <div class="buying-scheme__row">
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
              <span class="buying-scheme__chair buying-scheme__chair_vip"></span><span class="buying-scheme__chair buying-scheme__chair_taken"></span>
              <span class="buying-scheme__chair buying-scheme__chair_taken"></span><span class="buying-scheme__chair buying-scheme__chair_vip"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
              <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
            </div>  

            <div class="buying-scheme__row">
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_selected"></span>
              <span class="buying-scheme__chair buying-scheme__chair_selected"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
              <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
            </div>  

            <div class="buying-scheme__row">
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_taken"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_taken"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_taken"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            </div>  

            <div class="buying-scheme__row">
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_taken"></span>
              <span class="buying-scheme__chair buying-scheme__chair_taken"></span><span class="buying-scheme__chair buying-scheme__chair_taken"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
              <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            </div>
        </div>
        <div class="buying-scheme__legend">
          <div class="col">
            <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_standart"></span> Свободно (<span class="buying-scheme__legend-value">250</span>руб)</p>
            <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_vip"></span> Свободно VIP (<span class="buying-scheme__legend-value">350</span>руб)</p>            
          </div>
          <div class="col">
            <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_taken"></span> Занято</p>
            <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_selected"></span> Выбрано</p>                    
          </div>
        </div>
      </div>
      <button class="acceptin-button" onclick="location.href='payment.html'" >Забронировать</button>
    </section>     
  </main>
  
</body>
</html>