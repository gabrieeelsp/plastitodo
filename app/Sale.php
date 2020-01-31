<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

  public function client()
  {
    return $this->belongsTo(Client::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function fccomprobante()
  {
    return $this->hasOne(Fccomprobante::class);
  }

  public function saleitems()
  {
    return $this->hasMany(Saleitem::class);
  }

  public function payments()
  {
    return $this->hasMany(Payment::class);
  }

  public function getTotal()
  {
    $total = 0;
    foreach ($this->saleitems as $item) {
      $total = $total + $item->getSubTotal();
    }
    return round($total, 2);
  }

  public function getTotalConRecargo()
  {
    $total = $this->getTotal();
    foreach ($this->payments as $item) {
      $total = $total + $item->recargo;
    }
    return round($total, 2);
  }

  public function getTotalPayments()
  {
    $total = 0;
    foreach ($this->payments as $item) {
      $total = $total + $item->valor;
    }
    return round($total, 2);
  }

  public function getSaleItem($saleproducto_id)
  {
    foreach($this->saleitems as $item){
      if( $item->saleproduct->id == $saleproducto_id){
        return $item;
      }
    }
    return null;
  }

  public $timestamps = false;
}
