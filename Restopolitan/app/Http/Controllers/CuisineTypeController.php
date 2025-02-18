<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CuisineType;

class CuisineTypeController extends Controller
{
    /**
     * Muestra la lista de tipos de cocina.
     */
    public function index()
    {
        $cuisineTypes = CuisineType::all();
        return view('cuisine_types.index', compact('cuisineTypes'));
    }

    /**
     * Muestra el formulario para crear un nuevo tipo de cocina.
     */
    public function create()
    {
        return view('cuisine_types.create');
    }

    /**
     * Guarda un nuevo tipo de cocina en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:cuisine_types',
        ]);

        CuisineType::create($request->all());

        return redirect()->route('cuisine_types.index')->with('success', 'Tipo de cocina agregado correctamente.');
    }

    /**
     * Muestra un tipo de cocina específico.
     */
    public function show(CuisineType $cuisineType)
    {
        return view('cuisine_types.show', compact('cuisineType'));
    }

    /**
     * Muestra el formulario para editar un tipo de cocina.
     */
    public function edit(CuisineType $cuisineType)
    {
        return view('cuisine_types.edit', compact('cuisineType'));
    }

    /**
     * Actualiza un tipo de cocina en la base de datos.
     */
    public function update(Request $request, CuisineType $cuisineType)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:cuisine_types,name,' . $cuisineType->id,
        ]);

        $cuisineType->update($request->all());

        return redirect()->route('cuisine_types.index')->with('success', 'Tipo de cocina actualizado correctamente.');
    }

    /**
     * Elimina un tipo de cocina de la base de datos.
     */
    public function destroy(CuisineType $cuisineType)
    {
        $cuisineType->delete();

        return redirect()->route('cuisine_types.index')->with('success', 'Tipo de cocina eliminado correctamente.');
    }
}