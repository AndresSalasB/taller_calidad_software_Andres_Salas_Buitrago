<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    protected $fillable = [
        'tipo_documento',
        'numero_documento',
        'correo',
        'password',
        'rol',
        'nombre',
        'apellido',
        'telefono'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // Métodos para verificar roles
    public function isAdmin()
    {
        return $this->rol === 'Administrador';
    }

    public function isGerente()
    {
        return $this->rol === 'Gerente';
    }

    public function isCliente()
    {
        return $this->rol === 'Cliente';
    }
}
