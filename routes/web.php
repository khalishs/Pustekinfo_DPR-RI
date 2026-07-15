<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/profil', 'profil')->name('profil');

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $request->validate([
        'login' => ['required'],
        'password' => ['required'],
    ]);

    if (Auth::attempt([
        'name' => $request->input('login'),
        'password' => $request->input('password'),
    ], $request->boolean('remember'))) {
        $request->session()->regenerate();

        return redirect()->intended('/')->with('status', 'Login berhasil.');
    }

    return back()->withErrors([
        'login' => 'Data tidak valid.',
    ])->onlyInput('login');
})->name('login.post');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('home');
})->name('logout');