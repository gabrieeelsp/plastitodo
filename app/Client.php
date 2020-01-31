<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
  protected $fillable = [
    'name', 'slug', 'direccion', 'telefono', 'comentario', 'tipo', 'ivatipo_id'
  ];

  public function ivatipo()
  {
    return $this->belongsTo(Ivatipo::class);
  }

  public $timestamps = false;
}
