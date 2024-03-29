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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('students', 'StudentController')->except('show');
    Route::post('/students/decrement/{student}', 'StudentController@decrement')->name('students.decrement');
    Route::post('/students/increment/{student}', 'StudentController@increment')->name('students.increment');
    Route::get('/students/{student}/balance', 'StudentController@balance')->name('students.balance');
    Route::post('/students/coupons/update/{student}', 'StudentController@couponsUpdate')->name('students.coupons.update');
    Route::post('/students/coupons/earn/{student}', 'StudentController@couponsEarn')->name('students.coupons.earn');
    Route::post('/students/coupons/spend/{student}', 'StudentController@couponsSpend')->name('students.coupons.spend');
    Route::delete('/students/{student}', 'StudentController@destroy')->name('students.delete');
});
