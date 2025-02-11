<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id', // El campo role_id para asignar un rol al usuario
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the role associated with the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class); // Relación de muchos a uno con el modelo Role
    }

    /**
     * Get the reviews given by the user.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class); // Relación de uno a muchos con el modelo Review
    }

    /**
     * Get the restaurants created by the user (for gerente role).
     */
    public function restaurants()
    {
        return $this->hasMany(Restaurant::class, 'gerente_id'); // Relación con los restaurantes creados por este usuario (si es gerente)
    }
}
