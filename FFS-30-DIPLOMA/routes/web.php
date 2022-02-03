<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HallController;
use App\Http\Controllers\HallConfController;
use App\Http\Controllers\MovieScheduleController;


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

    Route::get('/index', function () { return view('client.index');})->name('index');

    Route::get('/admin',  [HallController::class, 'index'])->name('admin');
    
    Route::post('/admin/delete_hall/{id}',  [HallController::class, 'hallDelete'])->name('delete_hall');

    Route::get('/hall_add',  [HallController::class, 'store']);
    Route::get('/hall_add/conf',  [HallConfController::class, 'store'])->name('hall_conf');
    
    Route::get('/admin/{$hall_id}/{$movie_id}',  [MovieScheduleController::class, 'show']);
    
});


require __DIR__.'/auth.php';
