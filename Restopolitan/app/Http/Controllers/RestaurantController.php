<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\CuisineType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //Nos permite ejecutar consultas SQL más avanzadas, como cálculos con AVG().
class RestaurantController extends Controller
{
    // Mostrar la lista de restaurantes
    public function index()
    {
        $restaurants = Restaurant::all();
        $cuisineTypes = CuisineType::all();
        return view('home', compact('restaurants', 'cuisineTypes'));
        $restaurants = Restaurant::with(['gerente', 'location'])->get();
        return view('admin', compact('restaurants'));
    }

    // Mostrar el formulario de edición de un restaurante
    public function edit($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return response()->json($restaurant); // Devuelve los datos del restaurante en formato JSON
    }

    // Actualizar el restaurante
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'average_price' => 'required|numeric',
            'gerente_id' => 'nullable',
            'location_id' => 'required',
        ]);
    
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->name = $request->name;
        $restaurant->description = $request->description;
        $restaurant->average_price = $request->average_price;
        $restaurant->gerente_id = $request->gerente_id;
        $restaurant->location_id = $request->location_id;
        $restaurant->save();
    
        return response()->json(['success' => 'Restaurante actualizado con éxito.']);
    }
    

    // Eliminar un restaurante
    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();

        return response()->json(['success' => 'Restaurante eliminado con éxito.']);
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
        }*/

        if ($request->has('cuisine') && !empty($request->input('cuisine'))) {
            $query->having('cuisine_name', 'like', "%" . $request->input('cuisine') . "%");
        }

        if ($request->has('min_rating') && is_numeric($request->input('min_rating'))) {
            $query->having('avg_rating', '>=', (float) $request->input('min_rating'));
        }

        $restaurants = $query->get();

        return view('partials.restaurants', compact('restaurants'));
    }
}