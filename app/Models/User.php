<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Corregido a HasApiTokens (sin 'Api' duplicado si lo tenías)

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'rol' // Asegúrate de que esta columna sea 'rol' en tu base de datos, no 'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // <-- ¡NUEVO! Buena práctica en Laravel 10+ para auto-hashear
    ];

    // Métodos para verificar roles
    public function isAdmin() : bool // Agregando tipo de retorno para mayor claridad
    {
        return $this->rol === 'admin';
    }

    public function isRemitente() : bool // Agregando tipo de retorno para mayor claridad
    {
        return $this->rol === 'remitente';
    }

    public function isOperador() : bool // Agregando tipo de retorno para mayor claridad
    {
        return $this->rol === 'operador';
    }

    public function isTransportista() : bool // Agregando tipo de retorno para mayor claridad
    {
        return $this->rol === 'transportista';
    }
}