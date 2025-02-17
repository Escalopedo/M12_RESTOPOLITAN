<?php
namespace App\Http\Controllers;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    // Mostrar la lista de restaurantes
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('admin', compact('restaurants'));
    }

    // Mostrar el formulario de edición de un restaurante
    public function edit($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('restaurants.edit', compact('restaurant')); // Cambia la vista según tu ruta de vista de edición
    }

    // Actualizar el restaurante
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'average_price' => 'required|numeric',
            // Otros campos necesarios
        ]);

        $restaurant = Restaurant::findOrFail($id);
        $restaurant->name = $request->name;
        $restaurant->description = $request->description;
        $restaurant->average_price = $request->average_price;
        // Actualiza los demás campos...

        $restaurant->save();

        return redirect()->route('restaurants.index')->with('success', 'Restaurante actualizado con éxito.');
    }

    // Eliminar un restaurante
    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();

        return redirect()->route('restaurants.index')->with('success', 'Restaurante eliminado con éxito.');
    }
}