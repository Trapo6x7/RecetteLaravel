<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recette_ingredient', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recette_id');
            $table->unsignedBigInteger('ingredient_id');

            $table->foreign('recette_id')->references('id')->on('recettes')->onDelete('cascade');
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recette_ingredient');
    }
};
