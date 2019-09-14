<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $fillable = [
      'name', 'slug', 'direccion', 'telefono', 'horario', 'comentario'
    ];

    public $timestamps = false;
}
