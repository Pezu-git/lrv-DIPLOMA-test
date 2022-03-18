<?php

use SimpleSoftwareIO\QrCode\Facades\QrCode;

$hall_name = $_GET['hall_name'];
$movie_title = $_GET['movie_title'];
$start_time = $_GET['start_time'];
$places = $_GET['places'];
$QRtext = "Фильм: " . $movie_title . PHP_EOL . "Зал: "  . $hall_name . PHP_EOL . "Ряд/Место: " . $places . PHP_EOL . PHP_EOL . "Начало сеанса: " . $start_time . PHP_EOL . "Билет действителен строго на свой сеанс";
$q = QrCode::encoding('UTF-8')->size(200)->generate($QRtext)
?>


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
        <h2 class="ticket__check-title">Электронный билет</h2>
      </header>

      <div class="ticket__info-wrapper">
        <p class="ticket__info">На фильм: <span class="ticket__details ticket__title"><?php echo e($movie_title); ?></span></p>
        <p class="ticket__info">Места: <span class="ticket__details ticket__chairs"><?php echo e($places); ?></span></p>
        <p class="ticket__info">В зале: <span class="ticket__details ticket__hall"><?php echo e($hall_name); ?></span></p>
        <p class="ticket__info">Начало сеанса: <span class="ticket__details ticket__start"><?php echo e($start_time); ?></span></p>

        <p class="ticket__info-qr"><?php echo e($q); ?></p>

        <p class="ticket__hint">Покажите QR-код нашему контроллеру для подтверждения бронирования.</p>
        <p class="ticket__hint">Приятного просмотра!</p>
      </div>
    </section>
  </main>

</body>

</html><?php /**PATH C:\Users\artem\Desktop\Netology\lrv-DIPLOMA-test\FFS-30-DIPLOMA\resources\views/client/ticket.blade.php ENDPATH**/ ?>