<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id', 'avatar_url', 'bio', 'phone', 
        'country_code', 'birth_date', 'preferences'
    ];
}
