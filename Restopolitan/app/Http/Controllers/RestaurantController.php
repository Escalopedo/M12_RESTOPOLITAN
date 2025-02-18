<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\CuisineType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //Nos permite ejecutar consultas SQL más avanzadas, como cálculos con AVG().
class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        $cuisineTypes = CuisineType::all();
        return view('home', compact('restaurants', 'cuisineTypes'));
    }

    public function search(Request $request)
    {
        $query = Restaurant::join('restaurant_cuisine_types', 'restaurants.id', '=', 'restaurant_cuisine_types.restaurant_id')
            ->join('cuisine_types', 'restaurant_cuisine_types.cuisine_type_id', '=', 'cuisine_types.id')
            ->leftJoin('reviews', 'restaurants.id', '=', 'reviews.restaurant_id')
            ->select(
                'restaurants.*', //Muestra los datos de la tabla restaurants
                DB::raw("GROUP_CONCAT(DISTINCT cuisine_types.name SEPARATOR ', ') as cuisine_name"), //Obtiene el nombre del tipo de cocina
                DB::raw('COALESCE(AVG(reviews.rating), 0) as avg_rating') //Calcula la media de las valoraciones (AVG(reviews.rating)) y si su valor es null devuelve 0:
            )
            ->groupBy('restaurants.id'); //Esto evita que se dupliquen los resultados cuando se filtra

        if ($request->has('name') && !empty($request->input('name'))) {
            $query->where('restaurants.name', 'like', '%' . $request->input('name') . '%');
        }

        /*if ($request->has('min_price') && $request->has('max_price')) {
            $query->whereBetween('restaurants.average_price', [$request->input('min_price'), $request->input('max_price')]);
        }

        if ($request->has('min_rating') && is_numeric($request->input('min_rating'))) {
            $query->having('avg_rating', '>=', $request->input('min_rating'));
        }*/

        if ($request->has('cuisine') && !empty($request->input('cuisine'))) {
            $query->having('cuisine_name', 'like', "%" . $request->input('cuisine') . "%");
        }

        $restaurants = $query->get();

        return view('partials.restaurants', compact('restaurants'));
    }
}