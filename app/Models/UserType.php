<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    //
    protected $fillable = ['user_type', 'description'];

    public function users()
    {
        return $this->hasMany(User::class, 'user_type_id');
    }
}
