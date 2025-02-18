<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReviewController extends Controller
{
    
    public function store(Request $request, $id)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:1000',
    ]);
     // Buscar el restaurante por su ID
     $restaurant = Restaurant::findOrFail($id);
    $review = Review::create([
        'restaurant_id' => $restaurant->id,
        'user_id' => Auth::id(),
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);

    

    // Actualizar la calificación promedio del restaurante
    $averageRating = $restaurant->reviews()->avg('rating');
    $restaurant->update(['rating' => $averageRating]);

    return redirect()->route('restaurants.show', $restaurant->id)->with('success', 'Reseña añadida.');
}
}