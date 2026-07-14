<?php

use Illuminate\Support\Facades\Route;

Route::view('/profil', 'profil')->name('profil');
Route::get('/', function () {
    return view('home');
});
