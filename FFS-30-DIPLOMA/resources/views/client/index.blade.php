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
    @php
      $chose = 'page-nav__day_today page-nav__day_chosen ';
    @endphp
    @for($i = 0; $i < 7; $i++)
      <a class="page-nav__day {{$chose . $weekDayRus[$i][0]['weekEnd']}}" href="#" data-time-stamp=" {{$weekDayRus[$i][0]['timeStamp']}}">
      <span class="page-nav__day-week"> {{$weekDayRus[$i][0]['dayWeek']}}</span><span class="page-nav__day-number">{{$weekDayRus[$i][0]['day']}}</span>
      </a>
      @php
      $chose = '';
    @endphp
    @endfor
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
          @if($hallsSchedules[$i][$k][0] !== null)
          <div class="movie-seances__hall">
            <h3 class="movie-seances__hall-title">{{$hallsSchedules[$i][$k][0]}}</h3>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="/js/client_choosingDay.js"></script>
</body>

</html>