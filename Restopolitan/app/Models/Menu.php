<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    // Relación con los platos
    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }

    // Relación con el restaurante
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
