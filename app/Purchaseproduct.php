<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchaseproduct extends Model
{
  protected $fillable = [
    'proveedor_id', 'name', 'slug', 'rel_stock_compra', 'stockproduct_id',
  ];

  public function stockproduct()
  {
    return $this->belongsTo(Stockproduct::class);
  }

  public function proveedor()
  {
    return $this->belongsTo(Proveedor::class);
  }

  public $timestamps = false;
}
