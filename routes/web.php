<?php

use Illuminate\Support\Facades\Route;

use Filament\Facades\Filament;

Route::get('/login', function() {
    return redirect(Filament::getLoginUrl());
})->name('login');

Route::get('/', function () {
    return view('welcome');
});
