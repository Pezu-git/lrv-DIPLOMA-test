<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HallController;
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





// Route::get('/index', function () {
//     return view('index');
// })->middleware(['auth'])->name('index');

Route::get('/index',  [HallController::class, 'index'])->name('index');



require __DIR__.'/auth.php';
