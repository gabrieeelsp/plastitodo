@extends('layouts.index')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="col-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Rubros</li>
          </ol>
        </nav>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          Lista de Rubros
          <a href="{{ route('rubros.create') }}" class="btn btn-sm btn-primary">Nuevo</a>
        </div>
        <div class="card-body">
          @include('admin.rubros.partials.search')
          <table class="table table-striped table-hover table-bordered">
            <thead>
              <tr>
                <th width="10px">ID</th>
                <th>Nombre</th>
                <th colspan="3">&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              @foreach($rubros as $rubro)
              <tr>
                <td>{{ $rubro->id }}</td>
                <td>{{ $rubro->name }}</td>
                <td width="10px">
                  <a href="{{ route('rubros.show', $rubro->id) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                </td>
                <td width="10px">
                  <a href="{{ route('rubros.edit', $rubro->id) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                </td>
                <!--
                <td width="10px">
                  {{ Form::open(['route' => ['rubros.destroy', $rubro->id], 'method' => 'DELETE']) }}
                    <button class="btn btn-sm btn-danger">Eliminar</button>
                  {{ Form::close() }}
                </td>
              -->
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $rubros->render() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
