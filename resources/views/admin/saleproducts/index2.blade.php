@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Inicio</a></li>
          <li class="breadcrumb-item"><a href="{{ route('stockproducts.index') }}">Productos Stock</a></li>
          <li class="breadcrumb-item"><a href="{{ route('stockproducts.edit', $stockproduct->id) }}">{{ $stockproduct->name}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">Productos Venta</li>
        </ol>
      </nav>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          Lista de Productos Venta
          <a href="{{ route('stockproducts.saleproducts.create', $stockproduct->id) }}" class="btn btn-sm btn-primary">Nuevo</a>
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
              @foreach($saleproducts as $saleproduct)
              <tr>
                <td>{{ $saleproduct->id }}</td>
                <td>{{ $saleproduct->name }}</td>
                <!--
                <td width="10px">
                  <a href="{{ route('stockproducts.saleproducts.show', [$stockproduct->id, $saleproduct->id]) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                </td>
              -->
                <td width="10px">
                  <a href="{{ route('stockproducts.saleproducts.edit', [$stockproduct->id, $saleproduct->id]) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                </td>
                <!--
                <td width="10px">
                  {{ Form::open(['route' => ['stockproducts.saleproducts.destroy', $stockproduct->id, $saleproduct->id], 'method' => 'DELETE']) }}
                    <button class="btn btn-sm btn-danger">Eliminar</button>
                  {{ Form::close() }}
                </td>
              -->
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $saleproducts->render() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
