<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Payment;
use App\Paymentmethod;
use App\Sale;

class PaymentController extends Controller
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
    public function store( Request $request)
    {
        $sale = Sale::find($request->get('sale_id'));

        $paymentmethod = Paymentmethod::find($request->get('paymentmethod_id'));

        if($request->get('valor') == null){

          $valor = $sale->getTotal() - $sale->getTotalPayments();
          //dd($valor); 116.67
          $total = $valor * ( 1 + ( $paymentmethod->recargo / 100));

          $recargo = $total - $valor;

          //dd($valor . '   ' . $recargo);

        }else{
          $valor = round($request->get('valor') / ( 1 + ( $paymentmethod->recargo / 100 )), 2);

          $recargo = $request->get('valor') - $valor;


        }

        $payment = new Payment();
        $payment->valor = $valor;
        $payment->recargo = $recargo;
        $payment->paymentmethod_id = $paymentmethod->id;
        $payment->status = 'EDITANDO';
        if($sale->client != null){
          $payment->client_id = $sale->client->id;
        }
        $payment->sale_id = $sale->id;
        $payment->created_at = date("Y-m-d H:i:s.v");

        $payment->save();


        return redirect()->route('sales.edit', $sale->id);
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
    public function destroy(Request $request, $id)
    {

      Payment::find($id)->delete();

      return redirect()->route('sales.edit', $request->get('sale_id'));

    }
}
