<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    // Mostrar la lista de restaurantes
    public function index()
    {
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
}
