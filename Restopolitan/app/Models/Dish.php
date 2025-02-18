<?php
<<<<<<< HEAD
=======

>>>>>>> 01a45f78ed7b229cca68ae8930eba4f06fe738da
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $table = 'dishes';

    // Relación con el menú
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    // Relación con los tipos de cocina
    public function cuisines()
    {
        return $this->belongsToMany(CuisineType::class, 'dish_cuisine_types');
    }
}
