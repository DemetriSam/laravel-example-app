<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_recipe', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('ingredient_id');
            $table->bigInteger('recipe_id');
            $table->integer('quantity'); //кол-во ингредиента в рецепте в граммах
            $table->float('ccal', 7, 2)->nullable(); // вычисленные значения нутриентов
            $table->float('proteins', 7, 2)->nullable();
            $table->float('fats', 7, 2)->nullable();
            $table->float('carbs', 7, 2)->nullable();
            $table->float('fiber', 7, 2)->nullable();
            $table->float('share', 7, 2)->nullable(); //доля в весе рецепта
            $table->float('ccal_share', 7, 2)->nullable(); //доля в каллорийности рецепта
            $table->float('proteins_share', 7, 2)->nullable(); //доля в белках рецепта
            $table->float('fats_share', 7, 2)->nullable(); //доля в жирах рецепта
            $table->float('carbs_share', 7, 2)->nullable(); //доля в углеводах рецепта
            $table->float('fiber_share', 7, 2)->nullable(); //доля в клетчаке рецепта

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredient_recipe');
    }
};
