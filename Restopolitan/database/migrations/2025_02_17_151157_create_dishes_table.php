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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Nombre del plato
            $table->text('description')->nullable();  // Descripción del plato
            $table->decimal('price', 8, 2);  // Precio del plato
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade'); // Relación con el menú
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};
