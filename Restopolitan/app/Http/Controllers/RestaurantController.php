<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
public function index()
    {
        $restaurants = Restaurant::all(); // Obtienes todos los restaurantes
        $cuisineTypes = CuisineType::all();
        return view('restaurants.index', compact('restaurants','cuisineTypes')); // Pasas los restaurantes a la vista
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

        if ($request->has('cuisine') && !empty($request->input('cuisine'))) {
            $query->having('cuisine_name', 'like', "%" . $request->input('cuisine') . "%");
        }

        if ($request->has('min_rating') && is_numeric($request->input('min_rating'))) {
            $query->having('avg_rating', '>=', (float) $request->input('min_rating'));
        }

        if ($request->has('min_price') && is_numeric($request->input('min_price'))) {
            $query->where('restaurants.average_price', '>=', (float) $request->input('min_price'));
        }
    
        if ($request->has('max_price') && is_numeric($request->input('max_price'))) {
            $query->where('restaurants.average_price', '<=', (float) $request->input('max_price'));
        }

        $restaurants = $query->get();

        return view('partials.restaurants', compact('restaurants'));
    }
    public function filter(Request $request)
    {
        $filters = $request->all();
    
        $query = Restaurant::with(['gerente', 'location']);
    
        if (!empty($filters['id'])) {
            $query->where('id', 'like', "%{$filters['id']}%");
        }
    
        if (!empty($filters['name'])) {
            $query->where('name', 'like', "%{$filters['name']}%");
        }
    
        if (!empty($filters['description'])) {
            $query->where('description', 'like', "%{$filters['description']}%");
        }
    
        if (!empty($filters['average_price'])) {
            $query->where('average_price', 'like', "%{$filters['average_price']}%");
        }
    
        if (!empty($filters['gerente'])) {
            $query->whereHas('gerente', function ($q) use ($filters) {
                $q->where('name', 'like', "%{$filters['gerente']}%");
            });
        }
    
        if (!empty($filters['location'])) {
            $query->whereHas('location', function ($q) use ($filters) {
                $q->where('street_address', 'like', "%{$filters['location']}%")
                  ->orWhere('city', 'like', "%{$filters['location']}%")
                  ->orWhere('country', 'like', "%{$filters['location']}%");
            });
        }
    
        $restaurants = $query->get();
    
        return response()->json($restaurants);
    }
    
    public function show($id)
    {
        $restaurant = Restaurant::with('location')->findOrFail($id); 
        return view('restaurants.details', compact('restaurant'));
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

    // Almacenar un nuevo restaurante con AJAX
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'average_price' => 'required|numeric',
            'gerente_id' => 'required|exists:users,id', // Validar que el gerente exista
            'location_id' => 'required|exists:locations,id', // Validar que la ubicación exista
        ]);

        // Crear el nuevo restaurante
        $restaurant = Restaurant::create([
            'name' => $request->name,
            'description' => $request->description,
            'average_price' => $request->average_price,
            'gerente_id' => $request->gerente_id,
            'location_id' => $request->location_id,
        ]);

        // Responder con éxito si la solicitud es AJAX
        if ($request->ajax()) {
            return response()->json(['success' => 'Restaurante creado con éxito.', 'restaurant' => $restaurant]);
        }

        // Redirigir si no es una solicitud AJAX
        return redirect()->route('restaurants.index')->with('success', 'Restaurante creado con éxito.');
    }


}
