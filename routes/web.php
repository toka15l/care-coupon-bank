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
    Route::resource('students', 'StudentController');
    Route::post('/students/decrement/{student}', 'StudentController@decrement')->name('students.decrement');
    Route::post('/students/increment/{student}', 'StudentController@increment')->name('students.increment');
    Route::get('/students/spend/{student}', 'StudentController@spend')->name('students.spend');
    Route::post('/students/spend/{student}', 'StudentController@spendEdit')->name('students.spend.edit');
});
