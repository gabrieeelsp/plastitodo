<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debitnote extends Model
{
  public function client()
  {
    return $this->belongsTo(Client::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function debitnoteitems()
  {
    return $this->hasMany(Debitnoteitem::class);
  }

  public function ndcomprobante()
  {
    return $this->hasOne(Ndcomprobante::class);
  }

  public function getDebitnoteItem($saleproducto_id)
  {
    foreach($this->debitnoteitems as $item){
      if( $item->saleproduct->id == $saleproducto_id){
        return $item;
      }
    }
    return null;
  }

  public function getTotal()
  {
    $total = 0;
    foreach ($this->debitnoteitems as $item) {
      $total = $total + $item->getSubTotal();
    }
    return round($total, 2);
  }
    public $timestamps = false;
}
