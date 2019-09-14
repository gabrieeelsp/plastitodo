@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Inicio</a></li>
          <li class="breadcrumb-item"><a href="{{ route('clients.index') }}">Clientes</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $client->name}}</li>
        </ol>
      </nav>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          Editar Cliente

        </div>
        <div class="card-body">
          {!! Form::model($client, ['route' => ['clients.update', $client->id], 'method' => 'PUT']) !!}
            @include('admin.clients.partials.form')
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
