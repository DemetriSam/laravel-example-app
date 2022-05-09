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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('image', 2083)->nullable();
            $table->mediumText('description')->nullable();
            $table->float('ccal', 7, 2);
            $table->float('proteins', 7, 2);
            $table->float('fats', 7, 2);
            $table->float('carbs', 7, 2);
            $table->float('fiber', 7, 2)->default(0.00);

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
        Schema::dropIfExists('recipes');
    }
};
