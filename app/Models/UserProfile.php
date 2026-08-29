<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id', 'avatar_url', 'bio', 'phone', 
        'country_code', 'birth_date', 'preferences'
    ];

    // Castear automáticamente el JSON a Array en PHP
    protected $casts = [
        'preferences' => 'array',
        'birth_date' => 'date',
    ];

    // El perfil pertenece a un usuario (Inverse One-to-One)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
