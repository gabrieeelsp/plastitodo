<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  protected $fillable = [
    'valor', 'reacrgo', 'paymentmethod_id', 'sale_id'
  ];

  public function client()
  {
    return $this->belongsTo(Client::class);
  }

  public function paymentmethod()
  {
    return $this->belongsTo(Paymentmethod::class);
  }

  public function sale()
  {
    return $this->belongsTo(Sale::class);
  }

  public function getPagoConRecargo()
  {
    return $this->valor + $this->recargo;
  }

  public $timestamps = false;
}
