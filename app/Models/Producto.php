<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'marca',
        'modelo',
        'descripcion',
        'precio',
        'stock',
        'imagen',
        'usuario_id',
        'tipo_producto_id',
    ];
}
