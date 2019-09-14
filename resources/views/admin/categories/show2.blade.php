@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Inicio</a></li>
          <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categorías</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $category->name}}</li>
        </ol>
      </nav>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          Ver Categoría

        </div>
        <div class="card-body">
          <p><strong>Nombre:</strong> {{ $category->name }}</p>
          <p><strong>Slug:</strong> {{ $category->slug }}</p>
          <p><strong>Rubro:</strong> {{ $category->rubro->name }}</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
