<?php

use App\Http\Controllers\orderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/place-order',[orderController::class,'store']);


