<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $table = 'restaurants'; // Tabla personalizada para los restaurantes

    // Relación con el gerente (usuario)
    public function gerente()
    {
        return $this->belongsTo(User::class, 'gerente_id'); // Relación con la tabla users_restopolitan
    }

    // Relación con las reseñas
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Relación con los tipos de cocina
    public function cuisines()
    {
        return $this->belongsToMany(CuisineType::class, 'restaurant_cuisine_types');
    }
}
