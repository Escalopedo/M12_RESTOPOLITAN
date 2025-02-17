<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'restaurant_id',
        'user_id',
        'rating',
        'comment'
    ];

    protected $table = 'reviews';  // Tabla personalizada para las reseñas

    // Relación con el usuario que hizo la reseña
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el restaurante que recibió la reseña
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
