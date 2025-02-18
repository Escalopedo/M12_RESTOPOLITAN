<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantCuisineType extends Model
{
    use HasFactory;

    protected $table = 'restaurant_cuisine_types';  // Tabla pivote

    // Este modelo no necesita relaciones explícitas
}