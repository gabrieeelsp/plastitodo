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
          Ver Cliente

        </div>
        <div class="card-body">
          <p><strong>Nombre:</strong> {{ $client->name }}</p>
          <p><strong>Slug:</strong> {{ $client->slug }}</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
