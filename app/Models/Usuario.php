<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios'; // coincide con tu migración

    protected $fillable = [
        'tipo_documento',
        'numero_documento',
        'correo',
        'password',
        'rol',
        'nombre',
        'apellido',
        'telefono',
    ];

    protected $hidden = ['password'];

    // Si usas PK int autoincrement, esto es lo normal:
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
}
