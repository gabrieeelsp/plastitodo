<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saleproduct extends Model
{
  protected $fillable = [
    'stockproduct_id', 'name', 'slug', 'rel_venta_stock', 'porc_min', 'cant_may', 'porc_may', 'saleproductgroup_id',
  ];

  public function stockproduct()
  {
    return $this->belongsTo(Stockproduct::class);
  }

  public function saleproductgroup()
  {
    return $this->belongsTo(Saleproductgroup::class);
  }

  public function getStock()
  {
    return $this->stockproduct->stock / $this->rel_venta_stock;
  }

  public function getPrecioMin()
  {
    return round(($this->stockproduct->costo * (1 + ($this->porc_min / 100)) * $this->rel_venta_stock), 4);
  }
  public function getPrecioMay()
  {
    return round(($this->stockproduct->costo * (1 + ($this->porc_may / 100)) * $this->rel_venta_stock), 4);
  }

  public function getCosto()
  {
    return round($this->stockproduct->costo * $this->rel_venta_stock, 4);
  }

  public $timestamps = false;
}
