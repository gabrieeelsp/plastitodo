<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Sale;
use App\Saleproduct;

use \Cache;
use App\Client;
use App\Paymentmethod;
use App\Payment;
use App\Fccomprobante;
use Carbon\Carbon;

class SaleControllera extends Controller
{
  public function __construct()
    {
      $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {

       if($request->get('daterange') != null)
       {
         $rango = explode(' - ', $request->get('daterange'));

         $date1 = explode('/', $rango[0]);
         $from = $date1[2].'-'.$date1[1].'-'.$date1[0];
         $from = date($from);

         $date2 = explode('/', $rango[1]);
         $to = $date2[2].'-'.$date2[1].'-'.$date2[0];
         $to = date($to);

       }

       $query = trim($request->get('searchText'));

       $val = explode(' ', $query );
       $atr = [];
       foreach ($val as $q) {
         array_push($atr, ['name', 'LIKE', '%'.$q.'%'] );
       };



       if($request->get('searchText') != '')
       {
         if($request->get('daterange') != null){
           if($from == $to){
             //*searchText => true; dateRange => true; $from == $to => true
             $sales = Sale::orderBy('id', 'DESC')
                 ->whereHas('client', function ($query2) use ($atr) {
                 $query2->where($atr);
                 })
                 ->whereDate('created_at', $from)
                 ->paginate(10);

           }else{
             //*searchText => true; dateRange => true; $from == $to => false
             $sales = Sale::orderBy('id', 'DESC')
                 ->whereHas('client', function ($query2) use ($atr) {
                 $query2->where($atr);
                 })
                 ->whereBetween('created_at', [$from, $to])
                 ->paginate(10);

           }
         }else{
           //*searchText => true; dateRange => false; $from == $to => false
           $sales = Sale::orderBy('id', 'DESC')
               ->whereHas('client', function ($query2) use ($atr) {
                 $query2->where($atr);
               })
               ->paginate(10);
         }
       }else{
         if($request->get('daterange') != null){
           if($from == $to){
             //*searchText => false; dateRange => true; $from == $to => true
             $sales = Sale::orderBy('id', 'DESC')
                 ->whereDate('created_at', $from)
                 ->paginate(10);
           }else{
             //*searchText => false; dateRange => true; $from == $to => false
             $sales = Sale::orderBy('id', 'DESC')
                 ->whereBetween('created_at', [$from, $to])
                 ->paginate(10);
           }

         }else{
           //*searchText => false; dateRange => false; $from == $to => false
           $sales = Sale::orderBy('id', 'DESC')
             ->paginate(10);
         }
       }





           return view('admin.sales.index', ['sales' => $sales, 'searchText' => $query, 'daterange' => $request->get('daterange')]);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //creo una nueva ventas
      $sale = new Sale();
      //asigno created_at, tengo que actualizar este valor cada vez que realizo una operacion con una venta para ver si paso el tiempo para cancelarla
      $sale->created_at = date("Y-m-d H:i:s");

      //asigno el usuario loggeado
      $sale->user_id = auth()->user()->id;

      //guardo la venta en BD
      $sale->save();

      //voy a editar
      return redirect()->route('sales.edit', $sale->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Request $request, $id)
    {
      $sale = Sale::find($id);

      $sales_user = Sale::where('user_id', auth()->user()->id)
        ->where('status', 'EDITANDO')
        ->get();

      if($sale->status == 'COBRANDO'){

        $paymentmethods = Paymentmethod::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('admin.sales.edit_multipagos', ['sale' => $sale, 'sales_user' => $sales_user, 'paymentmethods' => $paymentmethods]);
      }
      $comprobantes = [];

      if($sale->client != null){
        $tipos_comprobante = $sale->client->ivatipo->documentgroups()->get();

        foreach($tipos_comprobante as $tipo){
          if($tipo->name == 'A'){

              array_push($comprobantes, 'A');
          }
          if($tipo->name == 'B'){

              array_push($comprobantes, 'B');
          }
          if($tipo->name == 'TZ'){
              //$comprobantes = array_add($comprobantes,'TZ', ['Ticket']);
              array_push($comprobantes, 'TZ');
          }

        }
      }


      //dd($comprobantes);

      return view('admin.sales.edit', ['sale' => $sale, 'id_edited' => $request->get('id_edited'), 'sales_user' => $sales_user, 'comprobantes' => $comprobantes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Sale::find($id)->delete();

      $sale_last = Sale::where('user_id', auth()->user()->id)
        ->where('status', 'EDITANDO')
        ->first();
      if($sale_last != null){
        return redirect()->route('sales.edit', $sale_last->id);
      }

      return redirect()->route('sales.index');
    }

    public function confirm_payment_multiple(Request $request, $id)
    {
      $sale = Sale::find($id);

      $sale->status = 'FINALIZADA';

      //Actualizo el stock de cada producto
      foreach($sale->saleitems as $item){
        $stockproduct = $item->saleproduct->stockproduct;

        $stockproduct->stock = $stockproduct->stock - ($item->cantidad * $item->saleproduct->rel_venta_stock);

        $stockproduct->update();
      }

      $sale->total = $sale->getTotal();

      //$sale->created_at = Carbon::now();

      //dd($sale->created_at);

      if($sale->client != null){
        $sale->saldo = $sale->client->saldo + $sale->getTotal();
      }

      $saldo = $sale->saldo;
      $sale->update();
      foreach($sale->payments as $payment){
        $saldo = $saldo - $payment->valor;
        if($sale->client != null){
          $payment->saldo = $saldo;
        }
        $payment->created_at = date("Y-m-d H:i:s");
        $payment->status = 'CONFIRMADO';
        $payment->update();
      }

      return redirect()->route('sales.index');
    }

    public function confirm_payment_efectivo(Request $request, $id)
    {
        $sale = Sale::find($id);

        $sale->status = 'FINALIZADA';

        //Actualizo el stock de cada producto
        foreach($sale->saleitems as $item){
          $stockproduct = $item->saleproduct->stockproduct;

          $stockproduct->stock = $stockproduct->stock - ($item->cantidad * $item->saleproduct->rel_venta_stock);

          $stockproduct->update();
        }

        $payment_efectivo = new Payment();

        if($sale->client != null){
          $sale->saldo = $sale->client->saldo + $sale->getTotal();

          $payment_efectivo->saldo = $sale->client->saldo;
          $payment_efectivo->client_id = $sale->client_id;
        }else{
          $payment_efectivo->sale_id = $sale->id;
        }

        $sale->total = $sale->getTotal();

        $sale->update();

        $payment_efectivo->created_at = date("Y-m-d H:i:s.v");

        $payment_efectivo->paymentmethod_id = 1;

        $payment_efectivo->valor = $sale->getTotal();

        $payment_efectivo->status = 'CONFIRMADO';

        $payment_efectivo->save();

        //si se generó todo correctamente
        if($this->emitir_comprobante($sale)){
          return redirect()->route('sales.index');
        }

        return redirect()->route('sales.index');


    }

    public function confirm_payment_cc(Request $request, $id)
    {
        $sale = Sale::find($id);

        $sale->status = 'FINALIZADA';

        //Actualizo el stock de cada producto
        foreach($sale->saleitems as $item){
          $stockproduct = $item->saleproduct->stockproduct;

          $stockproduct->stock = $stockproduct->stock - ($item->cantidad * $item->saleproduct->rel_venta_stock);

          $stockproduct->update();
        }

        $sale->saldo = $sale->client->saldo + $sale->getTotal();

        $payment_efectivo = new Payment();

        $sale->total = $sale->getTotal();

        $sale->update();

        $client = $sale->client;
        $client->saldo = $client->saldo - $sale->getTotal();
        $client->update();

        //si se generó todo correctamente
        if($this->emitir_comprobante($sale)){
          return redirect()->route('clients.show', $client->id);
        }

        return redirect()->route('clients.show', $client->id);


    }

    public function emitir_comprobante($sale)
    {
      if($sale->tipo_comprobante == null){

      }elseif($sale->tipo_comprobante == 'TZ'){

        $comprobante = new Fccomprobante();
        if($sale->client != null){
          $comprobante->client_id = $sale->client->id;
        }
        $comprobante->tipo = 'FCTZ';
        $comprobante->sale_id = $sale->id;

        $comprobante->valor = $sale->getTotal();

        //imprimo comprobante en la impresora fiscal
        if(true){  //si se imprimio correctmente devuelvo el numero de comprobante
          $comprobante->numero = '0001-00000343';
          $comprobante->created_at = $sale->created_at;
          $comprobante->save();

          return true;
        }


      }elseif($sale->tipo_comprobante == 'A'){
        $comprobante = new Fccomprobante();

        $comprobante->client_id = $sale->client->id;

        $comprobante->tipo = 'FCA';
        $comprobante->sale_id = $sale->id;

        $comprobante->valor = $sale->getTotal();

        //imprimo comprobante en la impresora fiscal
        if(true){  //si se imprimio correctmente devuelvo el numero de comprobante
          $comprobante->numero = '0001-00037464';
          $comprobante->created_at = $sale->created_at;
          $comprobante->save();

          return true;
        }

      }elseif($sale->tipo_comprobante == 'B'){
        $comprobante = new Fccomprobante();

        $comprobante->client_id = $sale->client->id;

        $comprobante->tipo = 'FCB';
        $comprobante->sale_id = $sale->id;

        $comprobante->valor = $sale->getTotal();

        //imprimo comprobante en la impresora fiscal
        if(true){  //si se imprimio correctmente devuelvo el numero de comprobante
          $comprobante->numero = '0001-0000443043';
          $comprobante->created_at = $sale->created_at;
          $comprobante->save();

          return true;
        }
      }
    }


    public function search(Request $request)
    {
      if($request->ajax())
        {
          $output="";
          $query = trim($request->search);
          $val = explode(' ', $query );
          $atr = [];
          foreach ($val as $q) {
            array_push($atr, ['name', 'LIKE', '%'.$q.'%'] );
          };
          $products = Saleproduct::orderBy('name', 'ASC')
            ->where($atr)
            ->get();
          if($products)
          {
            foreach ($products as $product) {

              if($request->get('tipo') == 'Minorista'){
                $precio = $product->getPrecioMin();
              }else{
                $precio = $product->getPrecioMay();
              }
              $output.='<tr class="clickable-row">'.
              '<td>'.$product->id.'</td>'.
              '<td>'.$product->name.'</td>'.
              '<td>'.$precio.'</td>'.
              '<td>'.$product->getStock().'</td>'.
              '<td><button class="btn btn-sm btn-success" onclick="select('.$product->id.')" data-dismiss="modal" >Seleccionar</button></td>'.
              '</tr>';
            }
            return Response($output);
          }

        }

    }

    public function update_client(Request $request, $id)
    {
        $sale = Sale::find($id);

        $sale->client_id = $request->get('client_id');

        $sale->tipo_comprobante = null;

        $sale->update();

        return redirect()->route('sales.edit', $sale->id);
    }

    public function set_multipagos(Request $request, $id)
    {
        $sale = Sale::find($id);

        $sale->status = 'COBRANDO';

        $sale->update();

        return redirect()->route('sales.edit', $sale->id);
    }

    public function cancel_multipagos(Request $request, $id)
    {
        $sale = Sale::find($id);

        $sale->status = 'EDITANDO';

        //delete todos los paymentmethod que tenga agregados
        Payment::where('sale_id', $id)->delete();

        $sale->update();

        return redirect()->route('sales.edit', $sale->id);
    }

    public function set_tipo_comprobante(Request $request, $id)
    {
        $sale = Sale::find($id);

        $sale->tipo_comprobante = $request->get('tipo_comprobante');

        $sale->update();

        return redirect()->route('sales.edit', $sale->id);
    }
}
