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
          <li class="breadcrumb-item"><a href="{{ route('stockproducts.saleproducts.index', $stockproduct->id) }}">Productos Venta</a></li>
          <li class="breadcrumb-item active" aria-current="page">NUEVO</li>
        </ol>
      </nav>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          Nuevo Producto Venta

        </div>
        <div class="card-body">
          {!! Form::open(['route' => ['stockproducts.saleproducts.store', $stockproduct->id]]) !!}
            @include('admin.saleproducts.partials.form')
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
