<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Proveedor;

class ProveedorController extends Controller
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

      $proveedors = Proveedor::orderBy('name', 'ASC')
        ->where($atr)
        ->paginate(10);

        $selectedItems = [];

        return view('admin.proveedors.index', ['proveedors' => $proveedors, 'searchText' => $query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.proveedors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $proveedor = Proveedor::create($request->all());

      return redirect()->route('proveedors.edit', $proveedor->id)
        ->with('info', 'Proveedor creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $proveedor = Proveedor::find($id);

      return view('admin.proveedors.show', compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $proveedor = Proveedor::find($id);

      return view('admin.proveedors.edit', compact('proveedor'));
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
      $proveedor = Proveedor::find($id);

      $proveedor->fill($request->all())->save();

      return redirect()->route('proveedors.edit', $proveedor->id)
        ->with('info', 'Proveedor editado con éxito');
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
