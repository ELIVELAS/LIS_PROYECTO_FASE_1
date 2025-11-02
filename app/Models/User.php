<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Tipo de usuario (admin/empresa/cliente)
    public function userType()
    {
        return $this->belongsTo(\App\Models\UserType::class, 'user_type_id');
    }

    // Relación 1–1 con Company (empresa que publica ofertas)
    public function company()
    {
        return $this->hasOne(\App\Models\Company::class, 'user_id');
    }

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'user_type_id',
        // 'username', // solo si realmente lo usas
    ];

    protected $hidden = ['password', 'remember_token'];

    // Hashea automáticamente la contraseña al asignarla
    protected $casts = [
        'password' => 'hashed',
    ];
}
