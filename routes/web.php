<?php

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

// Route::get('/coba','TestingController@index');

Route::get('/', function () {
    return redirect()->route('login');
});
//
// Route::get('/data_obat', function () {
//     return view('template.data_obat');
// })->name('apotek_data_obat');

Route::resource('/data_obat', 'ObatController');
Route::resource('/data_stok', 'StokObatController');
Route::resource('/data_peramalan', 'PeramalanController');
Route::resource('/data_perhitungan', 'PerhitunganController');
Route::get('logout','Auth\LoginController@logout');
Auth::routes();
//
// Route::get('/home', 'HomeController@index')->name('home');
