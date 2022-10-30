<?php

use Illuminate\Support\Facades\Route;

// временно
Route::get('/', function () {
    return view('welcome');
})->name('home');
//
