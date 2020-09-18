<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect('login');
});
Route::group(['prefix' => 'admin'], function () {
    Route::get('add-sift-karyawan', 'KaryawanController@siftKaryawan')->name('karyawan.sift');
    Route::post('add-sift-karyawan', 'KaryawanController@siftKaryawanStore')->name('karyawan.sift-store');
    Route::resource('karyawan', 'KaryawanController');
    Route::resource('absensi', 'AbsensiController');
    Route::get('setting-device/{id}', 'DeviceController@edit')->name('setting-device');
    Route::post('setting-device{id}', 'DeviceController@update')->name('update-device');
    Route::resource('sift', 'SiftController');
});
Route::get('absensi/export/', 'AbsensiController@export');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
