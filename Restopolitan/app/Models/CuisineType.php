namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuisineType extends Model
{
    use HasFactory;

    protected $table = 'cuisine_types';  // Tabla personalizada para los tipos de cocina

    // Relación muchos a muchos con restaurantes
    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'restaurant_cuisine_types');
    }

    // Relación muchos a muchos con platos (dishes)
    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'dish_cuisine_types');
    }
}
