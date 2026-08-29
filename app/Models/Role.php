<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','description','is_active'];

    public function users(){
        return $this->hasMany(User::Class);
    }
}
