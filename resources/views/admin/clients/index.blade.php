@extends('layouts.starter')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Clientes</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Clientes</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <!-- Main row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" >Lista de Clientes</h3>
              <a href="{{ route('clients.create') }}" class="btn btn-sm btn-primary" style="float:right;">Nuevo</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @include('admin.clients.partials.search')
              <table class="table table-striped table-hover table-bordered">
                <thead>
                  <tr>
                    <th width="10px">ID</th>
                    <th>Nombre</th>
                    <th width="10px">Tipo</th>
                    <th colspan="3">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($clients as $client)
                  <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->tipo }}</td>
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

              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@push('scripts')

@endpush
@endsection
