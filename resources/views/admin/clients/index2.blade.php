@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="col-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Clientes</li>
          </ol>
        </nav>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          Lista de Clientes
          <a href="{{ route('clients.create') }}" class="btn btn-sm btn-primary">Nuevo</a>
        </div>
        <div class="card-body">
          @include('admin.clients.partials.search')
          <table class="table table-striped table-hover table-bordered">
            <thead>
              <tr>
                <th width="10px">ID</th>
                <th>Nombre</th>
                <th colspan="3">&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              @foreach($clients as $client)
              <tr>
                <td>{{ $client->id }}</td>
                <td>{{ $client->name }}</td>
                <td width="10px">
                  <a href="{{ route('clients.show', $client->id) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                </td>
                <td width="10px">
                  <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                </td>

              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $clients->render() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
