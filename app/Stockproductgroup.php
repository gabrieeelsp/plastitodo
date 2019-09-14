<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stockproductgroup extends Model
{
  protected $fillable = [
    'name', 'slug',
  ];

  public function stockproducts()
  {
    return $this->hasMany(Stockproduct::class);
  }

  public $timestamps = false;
}
