<?php

namespace App\Http\Controllers;

use App\Models\recipes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class wareHouseController extends Controller
{
    public function verificarIngredientesDisponibles($receta)
    {

            // Verificar si la receta existe
        $recetaExistente = recipes::where('recipe_name', $receta)->exists();

        if (!$recetaExistente) {
            print('no existe la receta');
            return false;
        }
        // Obtener los ingredientes necesarios para la receta
        $ingredientesReceta = $this->obtenerIngredientesReceta($receta);
    
        // Verificar si todos los ingredientes necesarios están disponibles en la cantidad requerida
        foreach ($ingredientesReceta as $nombreIngrediente => $cantidadRequerida) {
            // Hacer una solicitud al microservicio de la bodega para verificar si el ingrediente está disponible
            $response = Http::get('http://localhost/Microservice_arq/Warehouse_service/public/prueba/' . $nombreIngrediente . '/' . $cantidadRequerida);
            $ingredientDisponible = $response->json();
    
            // Verificar si el ingrediente está disponible en la cantidad requerida
            if (!$ingredientDisponible) {
                // Si falta algún ingrediente o la cantidad disponible es menor que la requerida, devuelve falso
                return false;
            }
        }
    
        // Si todos los ingredientes están disponibles en las cantidades requeridas, devuelve verdadero
        return true;
    }

    private function obtenerIngredientesReceta($receta)
    {
        // Obtener los ingredientes de una receta por su nombre
        $ingredients = DB::table('recipes')
            ->join('recipe_ingredients', 'recipes.id', '=', 'recipe_ingredients.recipe_id')
            ->join('ingredients', 'recipe_ingredients.ingredient_id', '=', 'ingredients.id')
            ->where('recipes.recipe_name', '=', $receta)
            ->select('ingredients.name', 'recipe_ingredients.quantity')
            ->get();
    
        $recipeIngredients = [];
    
        // Construir el array de ingredientes necesarios
        foreach ($ingredients as $ingredient) {
            $recipeIngredients[$ingredient->name] = $ingredient->quantity;
        }
    
        return $recipeIngredients;
    }
}
