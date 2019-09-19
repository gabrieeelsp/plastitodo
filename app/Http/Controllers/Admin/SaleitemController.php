<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Saleitem;
use App\Saleproduct;
use App\Sale;

class SaleitemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($sale_id, Request $request)
    {

      $sale = Sale::find($sale_id);

      if($request->has('saleproduct_barcode')){
        $saleproduct = Saleproduct::where('barcode', $request->get('saleproduct_barcode'))->first();
        if($saleproduct != null){


          //Store por barcode BEGIN --------------------------------------------------------------


          //verifico el stock
          $stockVentasEditando = 0;
          $salesEDITANDO = Sale::where('status', 'EDITANDO')->get();

          foreach($salesEDITANDO as $saleEDITANDO){

            foreach($saleEDITANDO->saleitems as $item){
              //pregunto el item(Saleitem) refiere al producto stock que estoy ingresando
              if($item->saleproduct->stockproduct->id == $saleproduct->stockproduct->id){
                //entonces acumulo el stock, considerando la relacion_venta_stock
                $stockVentasEditando = $stockVentasEditando + $item->cantidad * $item->saleproduct->rel_venta_stock;
              }
            }


          }
          $stock_disponible = $saleproduct->getStock() - $stockVentasEditando / $saleproduct->rel_venta_stock;

          if($stock_disponible < 1){
            //Stock no es suficiente
            return redirect()->route('sales.edit', $sale_id);
          }
          //dd('Stock disponible: '. $stock_disponible);




          $precio = 0;
          if($sale->client != null && $sale->client->tipo == 'Mayorista'){
            //Venta registrada a un cliente, ver si es mayorista o minorista
            $precio = $saleproduct->getPrecioMay();
          }else{
            //tomo el precio Minorista
            $precio = $saleproduct->getPrecioMin();
          }

          //verifico que el producto no este ya en la misma Venta
          $saleitem = $sale->getSaleItem($saleproduct->id);
          if( $saleitem != null){
            $saleitem ->cantidad = $saleitem->cantidad + 1;
            $saleitem->update();

            //voy a editar
            return redirect()->route('sales.edit', ['sale_id' => $sale_id, 'id_edited' => $saleitem->id]);

          }

          $saleitem = Saleitem::create(['sale_id' => $sale_id, 'saleproduct_id' => $saleproduct->id, 'cantidad' => 1, 'precio' => $precio, 'descuento' => 0]);


          //voy a editar
          return redirect()->route('sales.edit', $sale_id);

          //Store por barcode END --------------------------------------------------------------




        }else{
          //No se encontro el Saleproduct segun el barcode
          return redirect()->route('sales.edit', $sale_id);
        }
      }



      $saleproduct = Saleproduct::find($request->get('saleproduct_id'));

      //verifico que el producto no este ya en la misma Venta
      if($sale->getSaleItem($request->get('saleproduct_id')) != null){
        return redirect()->route('sales.edit', $sale_id);
      }

      //verifico el stock
      $stockVentasEditando = 0;
      $salesEDITANDO = Sale::where('status', 'EDITANDO')->get();

      foreach($salesEDITANDO as $saleEDITANDO){

        foreach($saleEDITANDO->saleitems as $item){
          //pregunto el item(Saleitem) refiere al producto stock que estoy ingresando
          if($item->saleproduct->stockproduct->id == $saleproduct->stockproduct->id){
            //entonces acumulo el stock, considerando la relacion_venta_stock
            $stockVentasEditando = $stockVentasEditando + $item->cantidad * $item->saleproduct->rel_venta_stock;
          }
        }


      }
      $stock_disponible = $saleproduct->getStock() - $stockVentasEditando / $saleproduct->rel_venta_stock;

      if($stock_disponible < $request->get('cantidad')){
        //Stock no es suficiente
        return redirect()->route('sales.edit', $sale_id);
      }
      //dd('Stock disponible: '. $stock_disponible);




      $precio = 0;
      if($sale->client != null && $sale->client->tipo == 'Mayorista'){
        //Venta registrada a un cliente, ver si es mayorista o minorista
        $precio = Saleproduct::find($request->get('saleproduct_id'))->getPrecioMay();
      }else{
        //tomo el precio Minorista
        $precio = Saleproduct::find($request->get('saleproduct_id'))->getPrecioMin();
      }
      $saleitem = Saleitem::create($request->all() + ['sale_id' => $sale_id, 'precio' => $precio, 'descuento' => 0]);


      //voy a editar
      return redirect()->route('sales.edit', $sale_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($sale_id, Request $request, $id)
    {
      //Verifico que todos los datos sean enviados
      if($request->get('precio') == null || $request->get('descuento') == null || $request->get('cantidad') == null){
        return redirect()->route('sales.edit', ['sale_id' => $sale_id, 'id_edited' => 0]);
      }

        $saleitem = Saleitem::find($id);

        $saleproduct = $saleitem->saleproduct;

        if($request->get('cantidad') > $saleitem->cantidad){
          //verifico el stock
          $stockVentasEditando = 0;
          $salesEDITANDO = Sale::where('status', 'EDITANDO')->get();

          foreach($salesEDITANDO as $saleEDITANDO){

            foreach($saleEDITANDO->saleitems as $item){
              if($item->id != $id){
                //pregunto el item(Saleitem) refiere al producto stock que estoy ingresando
                if($item->saleproduct->stockproduct->id == $saleproduct->stockproduct->id){
                  //entonces acumulo el stock, considerando la relacion_venta_stock
                  $stockVentasEditando = $stockVentasEditando + $item->cantidad * $item->saleproduct->rel_venta_stock;
                }
              }
            }


          }
          $stock_disponible = $saleproduct->getStock() - $stockVentasEditando / $saleproduct->rel_venta_stock;

          if($stock_disponible < $request->get('cantidad')){
            //Stock no es suficiente
            return redirect()->route('sales.edit', ['sale_id' => $sale_id, 'id_edited' => $id]);
          }
        }

        $saleitem->precio = $request->get('precio');
        $saleitem->descuento = $request->get('descuento');
        $saleitem->cantidad = $request->get('cantidad');

        $saleitem->update();

        return redirect()->route('sales.edit', ['sale_id' => $sale_id, 'id_edited' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($sale_id, $id)
    {
      Saleitem::find($id)->delete();

      return back()->with('info', 'Eliminado correctamente.');
    }
}
