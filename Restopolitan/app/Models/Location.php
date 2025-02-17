<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'city', 'street_address', 'postal_code'
    ];

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }
}
