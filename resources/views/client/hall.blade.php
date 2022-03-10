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
          @for($j = 0; $j < $rows; $j++) <div class="buying-scheme__row">
            @for($k = 0; $k < $cols; $k++) <span class="buying-scheme__chair buying-scheme__chair_{{$seats[$hall->id][$j][$k][0]}}"></span>
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
    <script src="/js/client_moonbase.js"></script>

</html>