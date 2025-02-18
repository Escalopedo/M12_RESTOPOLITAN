<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\CuisineType;

class HomeController extends Controller
{
    public function index()
    {

        $cuisineTypes = CuisineType::all();

        // Obtener los restaurantes con foto
        $restaurants = Restaurant::whereNotNull('photo')->take(5)->get(); 

        return view('home', compact('restaurants','cuisineTypes'));
    }
}
