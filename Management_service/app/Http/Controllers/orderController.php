<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessOrder;
use App\Models\Order;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class orderController extends Controller
{
    public function index()
    {
        return Order::all();
    }

    public function show($id)
    {
        return Order::findOrFail($id);
    }

    protected function generateRandomOrder(): Order
    {
        $recipeId = rand(1, 6);
    
        $order = new Order([
            'recipe_id' => $recipeId,
            'status_id' => 1
        ]);
    
        $order->save();
    
        return $order;
    }

    public function store(Order $order){

        $recipes = [
            1 => 'riseMeat',
            2 => 'riseChicken',
            3 => 'chickenOnion',
            4 => 'meatCheese',
            5 => 'riceFried',
            6 => 'boom',
        ];

        $order = $this->generateRandomOrder();

        $recipe_id = $order->recipe_id;

    
        try {
            $response = Http::get('http://localhost/Microservice_arq/Kitchen_service/public/prueba/' . $recipes[$recipe_id]);
            //return $response;
    
            if ($response->ok() || $response->json() === 1) {
                $order->update(['status_id' => 2]);
                return response()-> json([
                    'message' => $order,
                ]);
            } else {
                echo 'No se pudo cocinar la orden ' . $recipes[$recipe_id];
            }
        } catch (\Exception $e) {
            return 'La solicitud HTTP falló: ' . $e->getMessage();
        }

        
    }

    public function destroy($id)
    {
        // Elimina la orden existente
    }

}
