<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creditnoteitem extends Model
{
  protected $fillable = [
    'saleproduct_id', 'creditnote_id', 'precio', 'descuento', 'cantidad',
  ];

  public function creditnote()
  {
    return $this->belongsTo(Creditnote::class);
  }

  public function saleproduct()
  {
    return $this->belongsTo(Saleproduct::class);
  }
  public function getPrecioDescuento()
  {
    return round($this->precio * (1 - $this->descuento / 100), 4);
  }

  public function getSubTotal()
  {
    return round(($this->getPrecioDescuento() * $this->cantidad), 4);
  }

  public $timestamps = false;
}
