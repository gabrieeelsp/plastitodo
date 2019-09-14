<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $fillable = [
    'rubro_id', 'name', 'slug',
  ];

  public function rubro()
  {
    return $this->belongsTo(Rubro::class);
  }

  public $timestamps = false;
}
