<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HallController;
use App\Http\Controllers\HallConfController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PriceListController;
use App\Http\Controllers\SeatController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth:sanctum'], function () {
//Начальная страница(/index)
    Route::get('/index', function () { return view('client.index');})->name('index');

//Адимн-панель(/admin)
    Route::get('/admin',  [HallController::class, 'index'])->name('admin');

//Удаление зала(halls)    
    Route::post('/admin/delete_hall/{id}',  [HallController::class, 'hallDelete'])->name('delete_hall');

//Добавление зала
    //...в таблицу с названием зала(halls)
    Route::get('/hall_add',  [HallController::class, 'store']);
    //...в таблицу с размерами зала(hall_confs)   
    Route::get('/hall_add/conf',  [HallConfController::class, 'store'])->name('hall_conf');
    //Добавление мест в зале(seats)
    Route::get('/admin/hall_chair_create/{hall_id}',  [SeatController::class, 'store'])->name('hall_chair_create');
    //Изменение категории мест в зале(seats)
    Route::get('/admin/hall_chair/{result}',  [SeatController::class, 'update']);
    //Удаление всех мест из зала
    Route::get('/admin/hall_chair_delete/{id}',  [SeatController::class, 'destroy'])->name('hall_chair_delete');

//Изменение цены(price_lists)    
    Route::get('/admin/save_price/{hall_id}/{st_price}/{vip_price}',  [PriceListController::class, 'update']);

//Добавление фильма(movies)
    Route::post('/add_movie',  [MovieController::class, 'store']);


    



    
});


require __DIR__.'/auth.php';
