@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Inicio</a></li>
          <li class="breadcrumb-item"><a href="{{ route('proveedors.index') }}">Proveedor</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $proveedor->name}}</li>
        </ol>
      </nav>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          Ver Proveedor

        </div>
        <div class="card-body">
          <p><strong>Nombre:</strong> {{ $proveedor->name }}</p>
          <p><strong>Slug:</strong> {{ $proveedor->slug }}</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
