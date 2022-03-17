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
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>

<body>

  <!--HallDelete-popup-->
  <div class="popup" id="deletePopup">
    <div class="popup__container">
      <div class="popup__content">
        <div class="popup__header">
          <h2 class="popup__title">
            Удаление зала
            <a class="popup__dismiss" href="#"><img src=<?php echo e(asset('assets/i/close.png')); ?> alt="Закрыть" id="delModalDissmis"></a>
          </h2>
        </div>
        <div class="popup__wrapper">
          <form accept-charset="utf-8" id="hallDeleteForm">
            <?php echo csrf_field(); ?>
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
  <div class=" popup" id="addPopup">
                <div class="popup__container">
                  <div class="popup__content">
                    <div class="popup__header">
                      <h2 class="popup__title">
                        Добавление зала
                        <a class="popup__dismiss" href="#"><img src="i/close.png" alt="Закрыть" id="addModalDissmis"></a>
                      </h2>
                    </div>
                    <div class="popup__wrapper">
                      <form accept-charset="utf-8" name="hallAddForm" id="hallAddForm">
                        <?php echo csrf_field(); ?>
                        <label class="conf-step__label conf-step__label-fullsize" for="name">
                          Название зала
                          <input class="conf-step__input" type="text" placeholder="Например, &laquo;Зал 1&raquo;" name="name" id="hallNameAdd" required>
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
                    <form accept-charset="utf-8" id="addMovieForm">
                      <?php echo csrf_field(); ?>
                      <label class="conf-step__label conf-step__label-fullsize" for="name">
                        Название фильма
                        <input class="conf-step__input" type="text" name="title" id="addMovieInput" required>
                      </label>
                      <label class="conf-step__label conf-step__label-fullsize" for="name">
                        Продолжительность
                        <input class="conf-step__input" type="text" name="duration" id="addMovieDurationInput" required>
                      </label>
                      <label class="conf-step__label conf-step__label-fullsize" for="name">
                        Описание фильма
                        <textarea class="conf-step__input" type="text" name="description" id="addMovieTextarea" required></textarea>
                      </label>
                      <label class="conf-step__label conf-step__label-fullsize" for="name">
                        Страна
                        <input class="conf-step__input" type="text" name="country" id="addMovieCountryInput" required>
                      </label>
                      <div class="conf-step__buttons text-center">
                        <input type="submit" value="Добавить фильм" class="conf-step__button conf-step__button-accent" id="addMovieToDbBtn">
                        <button class="conf-step__button conf-step__button-regular">Отменить</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <!--showtime_add-Popup-->
            <div class="popup" id="addShowtimePopup">
              <div class="popup__container">
                <div class="popup__content">
                  <div class="popup__header">
                    <h2 class="popup__title">
                      Добавление сеанса
                      <a class="popup__dismiss" href="#"><img src="i/close.png" alt="Закрыть" id="showtimeModalDissmis"></a>
                    </h2>

                  </div>
                  <div class="popup__wrapper">
                    <form id="seanceAddForm" accept-charset="utf-8">
                      <?php echo csrf_field(); ?>
                      <label class="conf-step__label conf-step__label-fullsize" for="hall_id">
                        Название зала
                        <select class="conf-step__input" name="hall_id" id="seance_hallName" required>
                          <?php $__currentLoopData = $halls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hall): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($hall->id); ?>" selected><?php echo e($hall->name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </label>
                      <label class="conf-step__label conf-step__label-fullsize" for="name">
                        Время начала
                        <input class="conf-step__input" type="time" value="00:00" name="start_time" id="seance_startTime" required>
                      </label>

                      <label class="conf-step__label conf-step__label-fullsize" for="movie_id">
                        Название фильма
                        <input class="conf-step__input movie_name" type="text" placeholder="Например, &laquo;Зал 1&raquo;" name="movie_name" id="seance_movieName" required>
                      </label>

                      <div class="conf-step__buttons text-center">
                        <input type="submit" value="Добавить" class="conf-step__button conf-step__button-accent">
                        <button class="conf-step__button conf-step__button-regular">Отменить</button>
                        <button type="button" class="conf-step__button conf-step__button-accent " id="movie_delete_btn" style="background-color: red;">Удалить фильм</button>
                      </div>
                    </form>

                  </div>
                </div>
              </div>
            </div>

            <!--schedules-delete-popup-->
            <div class="popup" id="delShowtimePopup">
              <div class="popup__container">
                <div class="popup__content">
                  <div class="popup__header">
                    <h2 class="popup__title">
                      Снятие с сеанса
                      <a class="popup__dismiss" href="#"><img src="i/close.png" alt="Закрыть" id="delShowtimeModalDissmis"></a>
                    </h2>

                  </div>
                  <div class="popup__wrapper">
                    <form accept-charset="utf-8" id="delete_hall_shedule">
                      <?php echo csrf_field(); ?>
                      <p class="conf-step__paragraph">Вы действительно хотите снять с сеанса фильм <span class="popupMovieName"></span>?</p>
                      <!-- В span будет подставляться название фильма -->
                      <div class="conf-step__buttons text-center">
                        <input type="submit" value="Удалить" class="conf-step__button conf-step__button-accent">
                        <button class="conf-step__button conf-step__button-regular">Отменить</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>


            <!--main-->
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
                    <?php $__currentLoopData = $halls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hall): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="hallDeleteList"><?php echo e($hall->name); ?>

                      <button class="conf-step__button conf-step__button-trash" type="button" id="<?php echo e($hall->id); ?>" data-delHall-id="<?php echo e($hall->id); ?>"></button>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                  <ul class="conf-step__selectors-box tabs__caption">
                    <?php $__currentLoopData = $halls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hall): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><input type="radio" class="conf-step__radio hide" name="chairs-hall" value="<?php echo e($hall->id); ?>"><span class="conf-step__selector"><?php echo e($hall->name); ?></span></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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




                  <?php for($i = 0; $i < $halls->count(); $i++): ?>

                    <div class="conf-step__hall" style="display: none">
                      <div class="conf-step__hall-wrapper">
                        <?php for($j = 0; $j < $hallConf[$i]['rows']; $j++): ?> <div class="conf-step__row">
                          <?php for($k = 0; $k < $hallConf[$i]['cols']; $k++): ?> <span class="conf-step__chair conf-step__chair_<?php echo e($seats[$halls[$i]->id][$j][$k][0]); ?>"></span>
                            <?php endfor; ?>
                      </div>
                      <?php endfor; ?>
                    </div>
                </div>
                <?php endfor; ?>


                <fieldset class="conf-step__buttons text-center">
                  <button class="conf-step__button conf-step__button-regular">Отмена</button>
                  <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent" id="hallConfSaveBtn">
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
              <?php $__currentLoopData = $halls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hall): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><input type="radio" class="conf-step__radio" name="prices-hall" value="<?php echo e($hall->id); ?>"><span class="conf-step__selector"><?php echo e($hall->name); ?></span></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>

            <p class="conf-step__paragraph">Установите цены для типов кресел:</p>
            <div class="conf-step__legend">
              <label class="conf-step__label">Цена, рублей<input type="text" class="conf-step__input" id="standartPrice"></label>
              за <span class="conf-step__chair conf-step__chair_standart"></span> обычные кресла
            </div>
            <div class="conf-step__legend">
              <label class="conf-step__label">Цена, рублей<input type="text" class="conf-step__input" id="vipPrice"></label>
              за <span class="conf-step__chair conf-step__chair_vip"></span> VIP кресла
            </div>

            <fieldset class="conf-step__buttons text-center">
              <button class="conf-step__button conf-step__button-regular">Отмена</button>
              <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent" id="savePrice">
            </fieldset>
          </div>
        </section>

        <section class="conf-step">
          <header class="conf-step__header conf-step__header_opened">
            <h2 class="conf-step__title">Сетка сеансов</h2>
          </header>
          <div class="conf-step__wrapper">
            <p class="conf-step__paragraph">
              <button class="conf-step__button conf-step__button-accent" id="addMovie" name="addMovie">Добавить фильм</button>
            </p>
            <!--Все фильмы кинотеатара-->
            <div class="conf-step__movies">
              <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="conf-step__movie">
                <img class="conf-step__movie-poster" alt="poster" src="i/posters/<?php echo e($movie->title); ?>.png">
                <h3 class="conf-step__movie-title" id="addForm-movie-title"><?php echo e($movie->title); ?></h3>
                <p class="conf-step__movie-duration"><?php echo e($movie->duration); ?></p>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <!--Сеансы-->
            <div class="conf-step__seances">
              <?php for($i = 0; $i < $halls->count(); $i++): ?>
                <div class="conf-step__seances-hall">
                  <h3 class="conf-step__seances-title"><?php echo e($halls[$i]->name); ?></h3>
                  <div class="conf-step__seances-timeline">
                    <?php for($j = 0; $j < $halls[$i]->seances->count(); $j++): ?>
                      <div class="conf-step__seances-movie" data-hallSchedule-id="<?php echo e($halls[$i]->id); ?>" style="width: <?php echo e($hallSeances[$halls[$i]->id][$j][0]); ?>px; 
                        background-color: rgb(133, 255, 137); left: <?php echo e($hallSeances[$halls[$i]->id][$j][1]); ?>px; cursor: pointer">
                        <p class="conf-step__seances-movie-title" data-hallSchedule-title="<?php echo e($halls[$i]->name); ?>"><?php echo e($hallSeances[$halls[$i]->id][$j][2]); ?></p>
                        <p class=" conf-step__seances-movie-start"><?php echo e($halls[$i]->seances[$j]->start_time); ?></p>
                      </div>
                      <?php endfor; ?>
                  </div>
                </div>
                <?php endfor; ?>

                <fieldset class="conf-step__buttons text-center">
                  <button class="conf-step__button conf-step__button-regular">Отмена</button>
                  <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent">
                </fieldset>
            </div>
        </section>

        <section class="conf-step">
          <header class="conf-step__header conf-step__header_opened">
            <h2 class="conf-step__title">Открыть продажи </h2>
          </header>
          <div class="conf-step__wrapper">

            <ul class="conf-step__selectors-box">
              <?php $__currentLoopData = $halls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hall): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><input type="radio" class="conf-step__radio <?php echo e($hallIsActive[$hall->id][0]); ?>" name="startOfSales-hall" value="<?php echo e($hall->id); ?>" id="startHallRadio" data-active="<?php echo e($hall->is_active); ?>"><span class="conf-step__selector"><?php echo e($hall->name); ?></span></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
          <div class="conf-step__wrapper text-center">
            <p class="conf-step__paragraph open-hall"></p>
            <button class="conf-step__button conf-step__button-accent startOfSalesBtn" id="startOfSalesBtn" disabled="true">Открыть продажу билетов</button>
          </div>
        </section>
        </main>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="/js/admin_moonbase.js"></script>


</body>

</html><?php /**PATH C:\Users\artem\Desktop\Netology\lrv-DIPLOMA-test\FFS-30-DIPLOMA\resources\views/admin/admin.blade.php ENDPATH**/ ?>