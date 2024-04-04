<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class ProcessOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new job instance.
     *
     * @param  Order  $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $recipes = [
            1 => 'riseMeat',
            2 => 'riseChicken',
            3 => 'chickenOnion',
            4 => 'meatCheese',
            5 => 'riceFried',
            6 => 'boom',
        ];


        if ($this->order->recipe_id) {
            $recipe_id = $this->order->recipe_id;
        } else {
            // Manejar el caso donde la relación 'recipe' no está establecida
            echo "La relación 'recipe' no está establecida para esta orden.";
            return "La relación 'recipe' no está establecida para esta orden.";
        }
    
        try {
            $response = Http::get('http://localhost/Microservice_arq/Kitchen_service/public/prueba/' . $recipes[$recipe_id]);
            //return $response;
    
            if ($response->ok() || $response->json() === 1) {
                $this->order->update(['status_id' => 2]);
                return 'Pedido terminado '. $recipes[$recipe_id];
            } else {
                echo 'No se pudo cocinar la orden ' . $recipes[$recipe_id];
            }
        } catch (\Exception $e) {
            return 'La solicitud HTTP falló: ' . $e->getMessage();
        }
    
        // Envía una notificación de orden procesada
        $this->sendOrderProcessedNotification();
        // Elimina el trabajo de la cola una vez que se haya procesado la orden
        $this->delete();
    }

    protected function sendOrderProcessedNotification()
    {
        $orderId = (string) $this->order->id;
        return 'La orden se ha procesado correctamente. ID de la orden finalizada: ' . $orderId;
    }
}
