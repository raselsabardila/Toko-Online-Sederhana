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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');


Route::get("barang/confirm","BarangController@confirm")->name("barang.confirm");
Route::get("/barang/checkout","BarangController@checkout")->name("barang.checkout");
Route::delete("/barang/batal/{id}","BarangController@batal")->name("barang.batal");

Route::resource("/barang","BarangController");
Route::post("/barang/pesan/{id}","BarangController@pesan")->name("barang.pesan");

Route::get("/history","HistoryController@index")->name("history.index");
Route::get("/history/{id}","HistoryController@detail")->name("history.detail");


Route::resource("/user","UserController");
