<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saleproductgroup extends Model
{
  protected $fillable = [
    'name', 'slug',
  ];

  public function saleproducts()
  {
    return $this->hasMany(Saleproduct::class);
  }

  public $timestamps = false;
}
