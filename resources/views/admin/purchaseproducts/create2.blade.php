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
          <li class="breadcrumb-item"><a href="{{ route('proveedors.purchaseproducts.index', $proveedor->id) }}">Productos Compra</a></li>
          <li class="breadcrumb-item active" aria-current="page">NUEVO</li>
        </ol>
      </nav>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          Nuevo Producto Compra

        </div>
        <div class="card-body">
          {!! Form::open(['route' => ['proveedors.purchaseproducts.store', $proveedor->id]]) !!}
            @include('admin.purchaseproducts.partials.form')
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
