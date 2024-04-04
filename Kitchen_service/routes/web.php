<?php

use App\Http\Controllers\wareHouseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/prueba/{recipe}',[wareHouseController::class,'verificarIngredientesDisponibles']);
