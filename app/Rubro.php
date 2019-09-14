<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubro extends Model
{
  protected $fillable = [
    'name', 'slug',
  ];

  public $timestamps = false;
}
