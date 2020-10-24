<?php

use App\Jobs\ProcessCalculate;
use Illuminate\Support\Facades\Route;

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
//
Route::get('/', function () {
    return view('pencarian');
});
Route::get('/hasil', 'Controller@hasil');
Route::get('/cekhasil', 'Controller@cekhasil');

Route::get('/test', 'Controller@test');

//Route::get('/test', function (){
//    $job = (new ProcessCalculate())->delay(now()->addSecond(10));
//    dispatch($job);
//    return "";
//});
Route::get('/artikel', 'Controller@artikel');
Route::post('/artikel', 'Controller@artikelPost');
Route::get('/artikel/list', 'Controller@artikelList');
Route::post('/artikel/hapus', 'Controller@artikelHapus');
Route::get('/artikel/detail', 'Controller@artikelDetail');
