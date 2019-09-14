<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Client;

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
  public function show($id)
  {
    $client = Client::find($id);

    return view('admin.clients.show', compact('client'));
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
