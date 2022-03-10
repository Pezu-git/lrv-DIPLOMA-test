<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HallController;
use App\Http\Controllers\HallConfController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PriceListController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\MovieScheduleController;
use App\Http\Controllers\TakenSeatsController;
use App\Http\Controllers\ClientMainPageController;
use App\Http\Controllers\ClientHallPageController;
use App\Http\Controllers\ClientPaymentPageController;
use App\Http\Controllers\ClientTicketPageController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Начальная страница(/index)
Route::get('/',  [ClientMainPageController::class, 'index'])->name('main');

//Страница выбора места(/hall)
Route::get('/hall',  [ClientHallPageController::class, 'index'])->name('client_hall');

//Обновление зала бронирования
Route::get('/client_hall', [TakenSeatsController::class, 'update']);

//Страница с данными бронирования
Route::get('/payment',  [ClientPaymentPageController::class, 'index'])->name('payment');

//Электронный билет
Route::get('/ticket',  [ClientTicketPageController::class, 'index'])->name('ticket');

//QR-code
Route::get('qr-code-g', function () {
    QrCode::size(500)
        ->format('png')
        ->generate('www.google.com', public_path('images/qrcode.png'));
    return view('qrCode');
});

//Администратор
Route::group(['middleware' => 'auth:sanctum'], function () {

    //Адимн-панель(/admin)
    Route::get('/admin',  [HallController::class, 'index'])->name('admin');

    //Удаление зала(halls)    
    Route::post('/delete_hall',  [HallController::class, 'destroy'])->name('delete_hall');

    //Добавление зала
    //...в таблицу с названием зала(halls)
    Route::post('/hall_add',  [HallController::class, 'store']);
    //...в таблицу с размерами зала(hall_confs)   
    Route::post('/hall_conf',  [HallConfController::class, 'store'])->name('hall_conf');
    //Добавление мест в зале(seats)
    Route::post('/admin/hall_chair_create/{result}',  [SeatController::class, 'store']);
    //Изменение категории мест в зале(seats)
    Route::get('/hall_chair',  [SeatController::class, 'update'])->name('hall_chair');
    //Удаление всех мест из зала(seats)
    Route::get('/admin/hall_chair_delete/{id}',  [SeatController::class, 'destroy'])->name('hall_chair_delete');

    //"Создание" цены
    Route::get('/show_price',  [PriceListController::class, 'show']);
    //Изменение цены(price_lists)    
    Route::post('/save_price',  [PriceListController::class, 'update']);

    //Добавление фильма(movies)
    Route::post('/add_movie',  [MovieController::class, 'store'])->name('filmAdd');
    //Удаление фильма(movies)
    Route::post('/delete_movie',  [MovieController::class, 'destroy'])->name('filmDelete');

    //Добавление сеанса
    Route::post('/add_movie_schedule',  [MovieScheduleController::class, 'store']);
    //Удаление сеанса
    Route::post('/delete_hall_shedule',  [MovieScheduleController::class, 'destroy']);
    //Открытие-закрытие продаж
    Route::post('/start_of_sales',  [HallController::class, 'setActive'])->name('start_of_sales');
});


require __DIR__ . '/auth.php';
