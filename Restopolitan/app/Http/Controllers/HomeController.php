<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener los restaurantes con foto
        $restaurants = Restaurant::whereNotNull('photo')->take(5)->get(); 

        return view('home', compact('restaurants'));
    }
}
