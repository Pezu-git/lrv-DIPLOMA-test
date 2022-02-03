<?php
use App\Models\Movie;
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

?>


<x-app-layout>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title name="header">>ИдёмВКино</title>
  <link rel="stylesheet" href="/css/admin_normalizemoonbase.css">
  <link rel="stylesheet" href="/css/admin_moonbase.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
</head>

<body>

<!--HallDelete-popup-->
<div class="popup" id="deletePopup">
  <div class="popup__container">
    <div class="popup__content">
      <div class="popup__header">
        <h2 class="popup__title">
          Удаление зала
          <a class="popup__dismiss" href="#"><img src={{asset('assets/i/close.png')}} alt="Закрыть" id="delModalDissmis"></a>
        </h2>
      </div>
      <div class="popup__wrapper">
        <form action="admin" method="post" accept-charset="utf-8" id="deleteForm">
        @csrf
          <p class="conf-step__paragraph">Вы действительно хотите удалить зал: <span class="popupHallName"></span>?</p>
          <!-- В span будет подставляться название зала -->
          <div class="conf-step__buttons text-center">
            <input type="submit" value="Удалить" class="conf-step__button conf-step__button-accent">
            <button class="conf-step__button conf-step__button-regular" ">Отменить</button>            
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!--HallAdd-popup-->
<div class="popup" id="addPopup">
  <div class="popup__container">
    <div class="popup__content">
      <div class="popup__header">
        <h2 class="popup__title">
          Добавление зала
          <a class="popup__dismiss" href="#"><img src="i/close.png" alt="Закрыть" id="addModalDissmis"></a>
        </h2>

      </div>
      <div class="popup__wrapper">
        <form action="hall_add" method="get" accept-charset="utf-8" name="hallAddForm">
        @csrf
          <label class="conf-step__label conf-step__label-fullsize" for="name">
            Название зала
            <input class="conf-step__input" type="text" placeholder="Например, &laquo;Зал 1&raquo;" name="name" required>
          </label>
          <div class="conf-step__buttons text-center">
            <input type="submit" value="Добавить зал" class="conf-step__button conf-step__button-accent" name="addHall">
            <button class="conf-step__button conf-step__button-regular">Отменить</button>            
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- MovieAdd-Popup-->
<div class="popup" id="addMoviePopup">
  <div class="popup__container">
    <div class="popup__content">
      <div class="popup__header">
        <h2 class="popup__title">
          Добавление фильма
          <a class="popup__dismiss" href="#"><img src="i/close.png" alt="Закрыть" id="movieModalDissmis"></a>
        </h2>

      </div>
      <div class="popup__wrapper">
        <form action="add_movie" method="post" accept-charset="utf-8">
          <label class="conf-step__label conf-step__label-fullsize" for="name">
            Название фильма
            <input class="conf-step__input" type="text" placeholder="Например, &laquo;Гражданин Кейн&raquo;" name="name" required>
          </label>
          <div class="conf-step__buttons text-center">
            <input type="submit" value="Добавить фильм" class="conf-step__button conf-step__button-accent" >
            <button class="conf-step__button conf-step__button-regular">Отменить</button>            
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

  <header class="page-header">
    <h1 class="page-header__title">Идём<span>в</span>кино</h1>
    <span class="page-header__subtitle">Администраторррская</span>
  </header>
  
  <main class="conf-steps">
    
    <section class="conf-step">
      
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Управление залами</h2>
        
      </header>
      
      <div class="conf-step__wrapper">
        
        <p class="conf-step__paragraph">Доступные залы:</p>
        
        <ul class="conf-step__list">
        @foreach($halls as $hall)
          <li class="hallDeleteList">{{ $hall->name }}
            <button class="conf-step__button conf-step__button-trash" type="button" id="{{ $hall->id }}"></button>
          </li>
          @endforeach
        </ul>
        
        <button class="conf-step__button conf-step__button-accent" id="hallAddPopupShow">Создать зал</button>
      </div>
     
    </section>
    
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Конфигурация залов</h2>
      </header>
      <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">Выберите зал для конфигурации:</p>
          <ul class="conf-step__selectors-box">
          @foreach($halls as $hall)
          <li><input type="radio" class="conf-step__radio" name="chairs-hall" value="{{ $hall->name }}" id="{{ $hall->id }}" checked><span class="conf-step__selector">{{ $hall->name }}</span></li>
          @endforeach
        </ul>
        <p class="conf-step__paragraph">Укажите количество рядов и максимальное количество кресел в ряду:</p>
        <div class="conf-step__legend">
          <label class="conf-step__label">Рядов, шт<input type="text" class="conf-step__input" placeholder="10" id="input_rows_count"></label>
          <span class="multiplier">x</span>
          <label class="conf-step__label">Мест, шт<input type="text" class="conf-step__input" placeholder="8" id="input_places_count"></label>
        </div>
        <p class="conf-step__paragraph">Теперь вы можете указать типы кресел на схеме зала:</p>
        <div class="conf-step__legend">
          <span class="conf-step__chair conf-step__chair_standart"></span> — обычные кресла
          <span class="conf-step__chair conf-step__chair_vip"></span> — VIP кресла
          <span class="conf-step__chair conf-step__chair_disabled"></span> — заблокированные (нет кресла)
          <p class="conf-step__hint">Чтобы изменить вид кресла, нажмите по нему левой кнопкой мыши</p>
        </div>  
        
        <div class="conf-step__hall">
          <div class="conf-step__hall-wrapper">
            <div class="conf-step__row">
              <span class="conf-step__chair conf-step__chair_disabled"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
              <span class="conf-step__chair conf-step__chair_disabled"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
              <span class="conf-step__chair conf-step__chair_disabled"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
            </div>  

            <div class="conf-step__row">
              <span class="conf-step__chair conf-step__chair_disabled"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_disabled"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
            </div>  

            <div class="conf-step__row">
              <span class="conf-step__chair conf-step__chair_disabled"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
            </div>  

            <div class="conf-step__row">
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_vip"></span>
              <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
            </div>  

            <div class="conf-step__row">
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_vip"></span>
              <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_vip"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
            </div>  

            <div class="conf-step__row">
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_vip"></span>
              <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_vip"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
            </div>  

            <div class="conf-step__row">
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_vip"></span>
              <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_vip"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
            </div>  

            <div class="conf-step__row">
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
            </div>  

            <div class="conf-step__row">
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
            </div>  

            <div class="conf-step__row">
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>          
            </div>
          </div>  
        </div>
        
        <fieldset class="conf-step__buttons text-center">
          <button class="conf-step__button conf-step__button-regular">Отмена</button>
          <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent">
        </fieldset>                 
      </div>
    </section>
    
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Конфигурация цен</h2>
      </header>
      <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">Выберите зал для конфигурации:</p>
        <ul class="conf-step__selectors-box">
        @foreach($halls as $hall)
          <li><input type="radio" class="conf-step__radio" name="prices-hall" value="Зал 1"><span class="conf-step__selector">{{ $hall->name }}</span></li>
        @endforeach  
        </ul>
          
        <p class="conf-step__paragraph">Установите цены для типов кресел:</p>
          <div class="conf-step__legend">
            <label class="conf-step__label">Цена, рублей<input type="text" class="conf-step__input" placeholder="0" ></label>
            за <span class="conf-step__chair conf-step__chair_standart"></span> обычные кресла
          </div>  
          <div class="conf-step__legend">
            <label class="conf-step__label">Цена, рублей<input type="text" class="conf-step__input" placeholder="0" value="350"></label>
            за <span class="conf-step__chair conf-step__chair_vip"></span> VIP кресла
          </div>  
        
        <fieldset class="conf-step__buttons text-center">
          <button class="conf-step__button conf-step__button-regular">Отмена</button>
          <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent">
        </fieldset>  
      </div>
    </section>
    
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Сетка сеансов</h2>
      </header>
      <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">
          <button class="conf-step__button conf-step__button-accent" id ="addMovie" name="addMovie">Добавить фильм</button>
        </p>
        <!--Все фильмы кинотеатара-->
        <div class="conf-step__movies">
          @foreach($movies as $movie)
          <div class="conf-step__movie">
            <img class="conf-step__movie-poster" alt="poster" src="i/poster.png">
            <h3 class="conf-step__movie-title">{{$movie->title}}</h3>
            <p class="conf-step__movie-duration">130 минут</p>
          </div>
          @endforeach
        </div>
         <!--Сеансы-->
        <div class="conf-step__seances">
          @for($i = 0; $i < $halls->count(); $i++)
          <div class="conf-step__seances-hall">
            <h3 class="conf-step__seances-title">{{$halls[$i]->name}}</h3>
            <div class="conf-step__seances-timeline">
              @for($j = 0; $j < $halls[$i]->seances->count(); $j++)
              <div class="conf-step__seances-movie" style="width: {{movieDuration($halls[$i]->seances[$j])}}px; background-color: rgb(133, 255, 137); left: {{movieStyleLeft($halls[$i]->seances[$j])}}px;">
                <p class="conf-step__seances-movie-title">{{movieTit($halls[$i]->seances[$j])}}</p>
                <p class="conf-step__seances-movie-start">{{$halls[$i]->seances[$j]->start_time}}</p>
              </div>
              @endfor
            </div>  
          </div>
          @endfor 
          
        <fieldset class="conf-step__buttons text-center">
          <button class="conf-step__button conf-step__button-regular">Отмена</button>
          <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent">
        </fieldset>  
      </div>
    </section>
    
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Открыть продажи</h2>
      </header>
      <div class="conf-step__wrapper text-center">
        <p class="conf-step__paragraph">Всё готово, теперь можно:</p>
        <button class="conf-step__button conf-step__button-accent">Открыть продажу билетов</button>
      </div>
    </section>  
      
  </main>



  <script src="/js/admin_moonbase.js"></script>
</body>
</html>
</x-app-layout>
