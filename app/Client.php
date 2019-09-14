<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
  protected $fillable = [
    'name', 'slug', 'direccion', 'telefono', 'comentario', 'tipo'
  ];

  public $timestamps = false;
}
