<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HallController;
use App\Http\Controllers\HallConfController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PriceListController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\MovieScheduleController;
use App\Http\Controllers\TakenSeatsController;
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
Route::get('/', function () {
    return view('client.index');
})->name('index');

Route::get('/hall', function () {
    return view('client.hall');
})->name('client_hall');

Route::get('/client_hall', [TakenSeatsController::class, 'update']);

Route::get('/payment', function () {
    return view('client.payment');
})->name('payment');

Route::get('/ticket', function () {
    return view('client.ticket');
})->name('ticket');

Route::get('qr-code-g', function () {
    QrCode::size(500)
        ->format('png')
        ->generate('www.google.com', public_path('images/qrcode.png'));
    return view('qrCode');
});

Route::group(['middleware' => 'auth:sanctum'], function () {

    //Адимн-панель(/admin)
    Route::get('/admin',  [HallController::class, 'index'])->name('admin');

    //Удаление зала(halls)    
    Route::post('/delete_hall',  [HallController::class, 'destroy'])->name('delete_hall');

    //Добавление зала
    //...в таблицу с названием зала(halls)
    Route::post('/hall_add',  [HallController::class, 'store']);
    //...в таблицу с размерами зала(hall_confs)   
    Route::get('/hall_add/conf',  [HallConfController::class, 'store'])->name('hall_conf');
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
