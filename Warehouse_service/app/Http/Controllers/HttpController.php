<?php

namespace App\Http\Controllers;

use App\Models\ingredients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class httpController extends Controller
{
    public function sendIngredients($name, $quantity = null)
    {
        $ingredient = ingredients::where('name', $name)->first();
    
        if (!$ingredient) {
            return response()->json(['error' => 'Ingredient not found'], 404);
        }
    
        if ($quantity !== null) {
            while ($ingredient->quantity < $quantity) {
                $response = Http::get('https://microservices-utadeo-arq-fea471e6a9d4.herokuapp.com/api/v1/software-architecture/market-place',
                    ['ingredient' => $name]
                );
    
                $data = $response->json();
    
                $ingredient->quantity += $data['data'][$name];
                $ingredient->save();
            }
    
            $ingredient->quantity -= $quantity;
            $ingredient->save();
        }

        return response()->json($ingredient);
    }
    



}