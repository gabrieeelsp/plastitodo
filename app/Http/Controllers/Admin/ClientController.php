<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

use App\Client;
use App\Payment;
use App\Sale;

class ClientController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {

    $query = trim($request->get('searchText'));

    $val = explode(' ', $query );
    $atr = [];
    foreach ($val as $q) {
      array_push($atr, ['name', 'LIKE', '%'.$q.'%'] );
    };

    $clients = Client::orderBy('name', 'ASC')
      ->where($atr)
      ->paginate(10);

      $selectedItems = [];

      return view('admin.clients.index', ['clients' => $clients, 'searchText' => $query]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('admin.clients.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $client = Client::create($request->all());

    return redirect()->route('clients.edit', $client->id)
      ->with('info', 'Cliente creado con éxito.');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request, $id)
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

    //dd($from. ' '. $to);

    $client = Client::find($id);


    if($request->get('daterange') != null){
      if($from == $to){
        //*dateRange => true; $from == $to => true
        $payments = DB::table("payments")
          ->where('client_id', $id)
          ->where('status', 'CONFIRMADO')
          ->whereDate('created_at', $from)
        ->select("payments.id",
          "payments.created_at",
          "payments.valor",
          "payments.saldo"
        )
        ->addSelect(DB::raw('1 as tipo'));

        $sales = DB::table("sales")
          ->where('client_id', $id)
          ->where('status', 'FINALIZADA')
          ->whereDate('created_at', $from)
            ->select("sales.id",
            "sales.created_at",
            "sales.total as valor",
            "sales.saldo",
            )
            ->addSelect(DB::raw('2 as tipo'))
            ->unionall($payments)
            ->orderBy('created_at', 'DESC')
            ->orderBy('id', 'DESC')
            ->paginate(10);
      }else{
        //*dateRange => true; $from == $to => false
        $payments = DB::table("payments")
          ->where('client_id', $id)
          ->where('status', 'CONFIRMADO')
          ->whereBetween('created_at', [$from, $to])
        ->select("payments.id",
          "payments.created_at",
          "payments.valor",
          "payments.saldo"
        )
        ->addSelect(DB::raw('1 as tipo'));

        $sales = DB::table("sales")
          ->where('client_id', $id)
          ->where('status', 'FINALIZADA')
          ->whereBetween('created_at', [$from, $to])
            ->select("sales.id",
            "sales.created_at",
            "sales.total as valor",
            "sales.saldo",
            )
            ->addSelect(DB::raw('2 as tipo'))
            ->unionall($payments)
            ->orderBy('created_at', 'DESC')
            ->orderBy('id', 'DESC')
            ->paginate(10);
      }
    }else{
      //*dateRange => false; $from == $to => false
      $payments = DB::table("payments")
        ->where('client_id', $id)
        ->where('status', 'CONFIRMADO')
      ->select("payments.id",
        "payments.created_at",
        "payments.valor",
        "payments.saldo"
      )
      ->addSelect(DB::raw('1 as tipo'));

      $sales = DB::table("sales")
        ->where('client_id', $id)
        ->where('status', 'FINALIZADA')
          ->select("sales.id",
          "sales.created_at",
          "sales.total as valor",
          "sales.saldo",
          )
          ->addSelect(DB::raw('2 as tipo'))
          ->unionall($payments)
          ->orderBy('created_at', 'DESC')
          ->orderBy('id', 'DESC')
          ->paginate(10);
    }


//--------------------------
    $items_sale = [];
    $items_payment = [];
    foreach($sales as $item){
        if($item->tipo == 2){
          array_push($items_sale, $item->id);
        }else{
          array_push($items_payment, $item->id);
        }

    }

    $sales_only = Sale::whereIn('id', $items_sale)->get();
    $payments_only = Payment::whereIn('id', $items_payment)->get();

    return view('admin.clients.show', ['client' => $client, 'rows' => $sales, 'sales_only' => $sales_only, 'payments_only' => $payments_only, 'daterange' => $request->get('daterange')]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $client = Client::find($id);

    return view('admin.clients.edit', compact('client'));
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
    $client = Client::find($id);

    $client->fill($request->all())->save();

    return redirect()->route('clients.edit', $client->id)
      ->with('info', 'Cliente editado con éxito');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      //
  }
}
