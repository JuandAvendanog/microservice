<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('quantity');
            $table->timestamps();
        });

        // Insertar ingredientes predeterminados
        $ingredients = [
            'tomato', 'lemon', 'potato', 'rice', 'ketchup',
            'lettuce', 'onion', 'cheese', 'meat', 'chicken'
        ];

        foreach ($ingredients as $ingredient) {
            DB::table('ingredients')->insert([
                'name' => $ingredient,
                'quantity' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Crear la tabla 'recipes'
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('recipe_name');
            $table->timestamps();
        });

        // Crear la tabla 'recipe_ingredients'
        Schema::create('recipe_ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ingredient_id')->constrained()->onDelete('cascade');
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->timestamps();
        });

        // Insertar recetas y sus ingredientes
        $recipes = [
            ['name' => 'riseMeat', 'ingredients' => [4 => 2, 9 => 1, 8 => 1, 7 => 2, 3 => 1]],
            ['name' => 'riseChicken', 'ingredients' => [4 => 2, 10 => 1, 8 => 1, 5 => 1, 2 => 1]],
            ['name' => 'chickenOnion', 'ingredients' => [10 => 2, 7 => 3, 6 => 1, 1 => 2]],
            ['name' => 'meatCheese', 'ingredients' => [9 => 2, 8 => 3, 1 => 1, 4 => 1]],
            ['name' => 'riceFried', 'ingredients' => [4 => 3, 1 => 2, 7 => 1, 6 => 2]],
            ['name' => 'boom', 'ingredients' => [1 => 2, 2 => 3, 8 => 1, 4 => 2, 5 => 1, 6 => 1, 7 => 2, 9 => 3, 10 => 1, 3 => 1]],
        ];

        foreach ($recipes as $recipe) {
            $recipeId = DB::table('recipes')->insertGetId([
                'recipe_name' => $recipe['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($recipe['ingredients'] as $ingredientId => $quantity) {
                DB::table('recipe_ingredients')->insert([
                    'recipe_id' => $recipeId,
                    'ingredient_id' => $ingredientId,
                    'quantity' => $quantity,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipe');
        Schema::dropIfExists('recipe_ingredients');
        Schema::dropIfExists('ingredients');
    }
};
