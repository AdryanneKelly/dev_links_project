<?php

use App\Livewire\Dev;
use App\Livewire\NotFound;
use Illuminate\Support\Facades\Route;

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
})->name('home');

Route::get('/dev/{nick}', Dev::class)->name('dev.show');
Route::get('/notfound', NotFound::class)->name('dev.notfound');
