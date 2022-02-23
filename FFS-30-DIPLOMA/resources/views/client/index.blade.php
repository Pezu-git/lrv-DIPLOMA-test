@php

use App\Models\Movie;
use App\Models\Hall;
use App\Models\Seat;
use App\Models\HallConf;
use App\Models\MovieSchedule;

$movies = Movie::all();
$halls = Hall::all();


function movieShedule($h, $movie_id) {
try{
$hallId = $h->seances->where('movie_id', $movie_id)->first()->hall_id;
return Hall::where('id', $hallId)->first()->name;
}
catch(Exception $e) {
return null;
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

  <nav class="page-nav">
    <a class="page-nav__day page-nav__day_today" href="#">
      <span class="page-nav__day-week">Пн</span><span class="page-nav__day-number">31</span>
    </a>
    <a class="page-nav__day" href="#">
      <span class="page-nav__day-week">Вт</span><span class="page-nav__day-number">1</span>
    </a>
    <a class="page-nav__day page-nav__day_chosen" href="#">
      <span class="page-nav__day-week">Ср</span><span class="page-nav__day-number">2</span>
    </a>
    <a class="page-nav__day" href="#">
      <span class="page-nav__day-week">Чт</span><span class="page-nav__day-number">3</span>
    </a>
    <a class="page-nav__day" href="#">
      <span class="page-nav__day-week">Пт</span><span class="page-nav__day-number">4</span>
    </a>
    <a class="page-nav__day page-nav__day_weekend" href="#">
      <span class="page-nav__day-week">Сб</span><span class="page-nav__day-number">5</span>
    </a>
    <a class="page-nav__day page-nav__day_next" href="#">
    </a>
  </nav>

  <main>
    @for($i = 0; $i < $movies->count(); $i++)
      <section class="movie">
        <div class="movie__info">
          <div class="movie__poster">
            <img class="movie__poster-image" alt="Звёздные войны постер" src="{{asset('assets/i/client_img/poster1.jpg')}}">
          </div>
          <div class="movie__description">
            <h2 class="movie__title">{{$movies[$i]->title}}</h2>
            <p class="movie__synopsis">Две сотни лет назад малороссийские хутора разоряла шайка нехристей-ляхов во главе с могущественным колдуном.</p>
            <p class="movie__data">
              <span class="movie__data-duration">{{$movies[$i]->duration}}</span>
              <span class="movie__data-origin">США</span>
            </p>
          </div>
        </div>

        @for($k = 0; $k < $halls->count(); $k++)
          @if(movieShedule($halls[$k], $movies[$i]->id))
          <div class="movie-seances__hall">
            <h3 class="movie-seances__hall-title">{{movieShedule($halls[$k], $movies[$i]->id)}}</h3>
            <ul class="movie-seances__list">
              @foreach($halls[$k]->seances->where('movie_id', $movies[$i]->id)->where('hall_id', $halls[$k]->id) as $key)
              <li class="movie-seances__time-block">
                <a class="movie-seances__time" href="{{route('client_hall', ['hall_name'=>$halls[$k]->name, 'movie'=>$movies[$i]->title, 'start_time'=>$key->start_time])}}">
                  {{$key->start_time}}
                </a>
              </li>
              @endforeach
            </ul>
          </div>
          @endif
          @endfor
      </section>
      @endfor
  </main>

</body>

</html>