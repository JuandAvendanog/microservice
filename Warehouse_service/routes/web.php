<?php

use App\Http\Controllers\httpController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/prueba/{ingredient}/{quantity}',[httpController::class,'sendIngredients']);

