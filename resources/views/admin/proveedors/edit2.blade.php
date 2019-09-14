@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Inicio</a></li>
          <li class="breadcrumb-item"><a href="{{ route('proveedors.index') }}">Proveedores</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $proveedor->name}}</li>
        </ol>
      </nav>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          Editar Proveedor

        </div>
        <div class="card-body">
          {!! Form::model($proveedor, ['route' => ['proveedors.update', $proveedor->id], 'method' => 'PUT']) !!}
            @include('admin.proveedors.partials.form')
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
