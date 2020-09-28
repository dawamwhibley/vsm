<?php

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

Route::get('/test', 'Controller@test');
Route::get('/artikel', 'Controller@artikel');
Route::post('/artikel', 'Controller@artikelPost');
Route::get('/artikel/list', 'Controller@artikelList');
Route::post('/artikel/hapus', 'Controller@artikelHapus');
