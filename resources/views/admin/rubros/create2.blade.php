@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Inicio</a></li>
          <li class="breadcrumb-item"><a href="{{ route('rubros.index') }}">Rubros</a></li>
          <li class="breadcrumb-item active" aria-current="page">NUEVO</li>
        </ol>
      </nav>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          Crear nuevo Rubro

        </div>
        <div class="card-body">
          {!! Form::open(['route' => 'rubros.store']) !!}
            @include('admin.rubros.partials.form')
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
