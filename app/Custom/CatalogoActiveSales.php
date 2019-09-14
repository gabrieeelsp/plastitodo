<?php namespace App\Custom;

use Illuminate\Support\Collection;
use App\Sale;

class CatalogoActiveSales
{

  public static $num_instances_created = 0;
  public function __construct
  (
    $in_prodid,
    $in_prodname,
    $in_proddesc,
    $in_price_pu,
    $in_location
  )
  {
    $this->id = $in_prodid;
    $this->name = $in_prodname;
    $this->desc = $in_proddesc;
    $this->price_per_unit = $in_price_pu;
    $this->location = $in_location;
    static::$num_instances_created++;
    //dd( "I've created " . self::$num_instances_created . " instances so far!<br/>\n");
  }


}
