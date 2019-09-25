<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Saleitem;
use App\Saleproduct;
use App\Sale;

class SaleitemControllera extends Controller
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
        $cantidad = 1;

        //No se encontro el BARCODE
        if($saleproduct == null){  //No se encontro el BARCODE
          return redirect()->route('sales.edit', $sale_id);
        }

        //verifico que el producto no este ya en la misma Venta
        //Si lo encuentro aumento en uno la cantidad
        $saleitem = $sale->getSaleItem($saleproduct->id);
        if($saleitem != null){

          $request->replace(['precio' => $saleitem->precio, 'descuento' => $saleitem->descuento, 'cantidad' => $saleitem->cantidad + 1]);

          return $this->update($sale_id, $request, $saleitem->id);

        }

      }else{
        $saleproduct = Saleproduct::find($request->get('saleproduct_id'));
        $cantidad = $request->get('cantidad');

        //verifico que el producto no este ya en la misma Venta
        if($sale->getSaleItem($saleproduct->id) != null){
          return redirect()->route('sales.edit', $sale_id);
        }

      }

      //Verifico el stock
      $stock_disponible = $this->getStockDisponible($saleproduct->id);
      if($stock_disponible < $cantidad){
        return redirect()->route('sales.edit', $sale_id);
      }



      //Ya puedo ingresar el Saleitem
      $precio = 0;
      if($sale->client != null && $sale->client->tipo == 'Mayorista'){
        //Venta registrada a un cliente, ver si es mayorista o minorista
        $precio = $saleproduct->getPrecioMay();
      }else{
        //tomo el precio Minorista
        $precio = $saleproduct->getPrecioMin();
      }

      $saleitem = Saleitem::create( ['cantidad' => $cantidad, 'saleproduct_id' => $saleproduct->id, 'sale_id' => $sale_id, 'precio' => $precio, 'descuento' => 0]);


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
      $precio = str_replace(',','',$request->get('precio'));
      $cantidad = str_replace(',','',$request->get('cantidad'));


      $saleitem = Saleitem::find($id);

      $saleproduct = $saleitem->saleproduct;

      if($request->get('cantidad') > $saleitem->cantidad){
        //Verifico el stock
        $stock_disponible = $this->getStockDisponible($saleproduct->id);
        $stock_disponible = $stock_disponible + $saleitem->cantidad;

        //Stock no disponible
        if($stock_disponible < $request->get('cantidad')){
          return redirect()->route('sales.edit', $sale_id);

        }

      }
      //dd($precio);
      $saleitem->precio = $precio;
      $saleitem->descuento = $request->get('descuento');
      $saleitem->cantidad = $cantidad;

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

    private function getStockDisponible($saleproduct_id)
    {

      $saleproduct = Saleproduct::find($saleproduct_id);

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

      return $stock_disponible;

    }
}
