@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Inicio</a></li>
          <li class="breadcrumb-item"><a href="{{ route('proveedors.index') }}">Proveedores</a></li>
          <li class="breadcrumb-item"><a href="{{ route('proveedors.edit', $proveedor->id) }}">{{ $proveedor->name}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">Productos Compra</li>
        </ol>
      </nav>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          Lista de Productos Compras
          <a href="{{ route('proveedors.purchaseproducts.create', $proveedor->id) }}" class="btn btn-sm btn-primary">Nuevo</a>
        </div>
        <div class="card-body">

          <table class="table table-striped table-hover table-bordered">
            <thead>
              <tr>
                <th width="10px">ID</th>
                <th>Nombre</th>
                <th colspan="1">&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              @foreach($purchaseproducts as $purchaseproduct)
              <tr>
                <td>{{ $purchaseproduct->id }}</td>
                <td>{{ $purchaseproduct->name }}</td>
                <!--
                <td width="10px">
                  <a href="{{ route('proveedors.purchaseproducts.show', [$proveedor->id, $purchaseproduct->id]) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                </td>
              -->
                <td width="10px">
                  <a href="{{ route('proveedors.purchaseproducts.edit', [$proveedor->id, $purchaseproduct->id]) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                </td>
                

              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $purchaseproducts->render() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
