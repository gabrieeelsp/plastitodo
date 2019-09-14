@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Inicio</a></li>
          <li class="breadcrumb-item"><a href="{{ route('stockproducts.index') }}">Productos Stock</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $stockproduct->name}}</li>
        </ol>
      </nav>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          Ver Producto Stock

        </div>
        <div class="card-body">
          <p><strong>Nombre:</strong> {{ $stockproduct->name }}</p>
          <p><strong>Slug:</strong> {{ $stockproduct->slug }}</p>
          <p><strong>Categoría:</strong> {{ $stockproduct->category->name }}</p>
          <p><strong>Stock:</strong> {{ $stockproduct->stock }}</p>
          <p><strong>Costo:</strong> {{ $stockproduct->costo }}</p>
          <a class="nav-link" href="{{ route('stockproducts.saleproducts.index', $stockproduct->id) }}">Productos Venta</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
