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
          Editar Categoría

        </div>
        <div class="card-body">
          {!! Form::model($category, ['route' => ['categories.update', $category->id], 'method' => 'PUT']) !!}
            @include('admin.categories.partials.form')
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
