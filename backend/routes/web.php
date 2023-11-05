<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BejelentkezoRendszer;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [BejelentkezoRendszer::class, 'index'])->name('login');
Route::post('post-login', [BejelentkezoRendszer::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [BejelentkezoRendszer::class, 'registration'])->name('register');
Route::post('post-registration', [BejelentkezoRendszer::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [BejelentkezoRendszer::class, 'dashboard']); 
Route::get('logout', [BejelentkezoRendszer::class, 'logout'])->name('logout');