<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Purchaseproduct;
use App\Proveedor;
use App\Stockproduct;

class PurchaseproductController extends Controller
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
     public function index($proveedor_id = 0, Request $request)
     {

       $query = trim($request->get('searchText'));

       $val = explode(' ', $query );
       $atr = [];
       foreach ($val as $q) {
         array_push($atr, ['name', 'LIKE', '%'.$q.'%'] );
       };

       $purchaseproducts = Purchaseproduct::orderBy('name', 'ASC')
         ->where('proveedor_id', $proveedor_id)
         ->where($atr)
         ->paginate(5);

         $proveedor = Proveedor::find($proveedor_id);

         return view('admin.purchaseproducts.index', ['purchaseproducts' => $purchaseproducts, 'searchText' => $query, 'proveedor' => $proveedor]);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create($proveedor_id)
     {
       $proveedor = Proveedor::find($proveedor_id);

       $stockproducts = Stockproduct::orderBy('name', 'ASC')->pluck('name', 'id');

       return view('admin.purchaseproducts.create', compact('proveedor', 'stockproducts'));
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store($proveedor_id, Request $request)
     {
       $purchaseproduct = Purchaseproduct::create($request->all() + ['proveedor_id' => $proveedor_id]);


       return redirect()->route('proveedors.purchaseproducts.edit', [$proveedor_id, $purchaseproduct->id])
         ->with('info', 'Producto Compra editado con éxito.');
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
     public function edit($proveedor_id, $id)
     {

       $purchaseproduct = Purchaseproduct::find($id);

       $proveedor = Proveedor::find($proveedor_id);

       return view('admin.purchaseproducts.edit', compact('purchaseproduct', 'proveedor'));
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update($proveedor_id, Request $request, $id)
     {
       $purchaseproduct = Purchaseproduct::find($id);

       $purchaseproduct->fill($request->all())->save();

       return redirect()->route('proveedors.purchaseproducts.edit', [$proveedor_id, $purchaseproduct->id])
         ->with('info', 'Producto Compra editado con éxito.');
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
