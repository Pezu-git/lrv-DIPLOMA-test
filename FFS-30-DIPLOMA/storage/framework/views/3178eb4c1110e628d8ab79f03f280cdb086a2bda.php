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
    <?php
    $chose = 'page-nav__day_today page-nav__day_chosen ';
    ?>
    <?php for($i = 0; $i < 7; $i++): ?> <a class="page-nav__day <?php echo e($chose . $weekDayRus[$i][0]['weekEnd']); ?>" href="#" data-time-stamp=" <?php echo e($weekDayRus[$i][0]['timeStamp']); ?>">
      <span class="page-nav__day-week"> <?php echo e($weekDayRus[$i][0]['dayWeek']); ?></span><span class="page-nav__day-number"><?php echo e($weekDayRus[$i][0]['day']); ?></span>
      </a>
      <?php
      $chose = '';
      ?>
      <?php endfor; ?>
  </nav>


  <main>
    <?php for($i = 0; $i < $movies->count(); $i++): ?>
      <section class="movie">
        <div class="movie__info">
          <div class="movie__poster">
            <img class="movie__poster-image" alt="<?php echo e($movies[$i]->title); ?>" src="i/posters/<?php echo e($movies[$i]->title); ?>.png">
          </div>
          <div class="movie__description">
            <h2 class="movie__title"><?php echo e($movies[$i]->title); ?></h2>
            <p class="movie__synopsis"><?php echo e($movies[$i]->description); ?></p>
            <p class="movie__data">
              <span class="movie__data-duration"><?php echo e($movies[$i]->duration); ?></span>
              <span class="movie__data-origin"><?php echo e($movies[$i]->country); ?></span>
            </p>
          </div>
        </div>

        <?php for($k = 0; $k < $halls->count(); $k++): ?>
          <?php if($hallsSchedules[$i][$k][0] !== null): ?>
          <div class="movie-seances__hall">
            <h3 class="movie-seances__hall-title"><?php echo e($hallsSchedules[$i][$k][0]); ?></h3>
            <ul class="movie-seances__list">
              <?php $__currentLoopData = $halls[$k]->seances->where('movie_id', $movies[$i]->id)->where('hall_id', $halls[$k]->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li class="movie-seances__time-block">
                <a class="movie-seances__time" href="<?php echo e(route('client_hall', ['hall_name'=>$halls[$k]->name, 'movie'=>$movies[$i]->title, 'start_time'=>$key->start_time])); ?>">
                  <?php echo e($key->start_time); ?>

                </a>
              </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
          <?php endif; ?>
          <?php endfor; ?>
      </section>
      <?php endfor; ?>
  </main>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="/js/client_choosingDay.js"></script>
</body>

</html><?php /**PATH C:\Users\artem\Desktop\Netology\lrv-DIPLOMA-test\FFS-30-DIPLOMA\resources\views/client/index.blade.php ENDPATH**/ ?>