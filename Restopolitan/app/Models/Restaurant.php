<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $table = 'restaurants'; // Tabla personalizada para los restaurantes
    
     // Propiedades que pueden ser asignadas masivamente
     protected $fillable = [
        'name',
        'description',
        'average_price',
        'photo',
        'gerente_id',
        'location_id',
        'rating' 
    ];

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

    // Relación con la localización 
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
