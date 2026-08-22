<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    return 'Dashboard';

})->middleware('auth');

Route::get('/', [HomeController::class, 'index'])

    ->middleware('auth');
