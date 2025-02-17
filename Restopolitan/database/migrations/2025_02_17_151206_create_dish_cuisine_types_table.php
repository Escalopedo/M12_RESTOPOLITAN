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
        Schema::create('dish_cuisine_types', function (Blueprint $table) {
            $table->foreignId('dish_id')->constrained('dishes')->onDelete('cascade');  // Relación con el plato
            $table->foreignId('cuisine_type_id')->constrained('cuisine_types')->onDelete('cascade');  // Relación con el tipo de cocina
            $table->primary(['dish_id', 'cuisine_type_id']); // Clave primaria compuesta
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dish_cuisine_types');
    }
};
