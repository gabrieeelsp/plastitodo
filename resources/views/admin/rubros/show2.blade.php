@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Inicio</a></li>
          <li class="breadcrumb-item"><a href="{{ route('rubros.index') }}">Rubros</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $rubro->name}}</li>
        </ol>
      </nav>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          Ver Rubro

        </div>
        <div class="card-body">
          <p><strong>Nombre:</strong> {{ $rubro->name }}</p>
          <p><strong>Slug:</strong> {{ $rubro->slug }}</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
