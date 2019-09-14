@extends('layouts.starter')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Existencias</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Existencias</li>
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
              <h3 class="card-title" >Lista de Productos Stock en Existencia</h3>
              <a href="{{ route('stockproducts.create') }}" class="btn btn-sm btn-primary" style="float:right;">Nuevo</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @include('admin.stockproducts.partials.search_existencias')
              <table  class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="10px">ID</th>
                    <th>Nombre</th>
                    <th width="10px">Costo</th>
                    <th width="10px">Local</th>
                    <th width="10px">Depósito</th>
                    <th colspan="1">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- {{ $count = 0 }} -->
                  @foreach($stockproducts as $stockproduct)
                  @if(in_array($stockproduct->id, $selectedItems))
                  <tr class="table-primary">
                  @else
                  <tr>
                  @endif
                    <td>{{ $stockproduct->id }}</td>
                    <td>{{ $stockproduct->name }}</td>
                    <td style="text-align: right;">{{ $stockproduct->costo }}</td>
                    <td style="text-align: right;">{{ $stockproduct->stock }}</td>
                    <td style="text-align: right;">{{ $stockproduct->stock_deposito }}</td>

                    <td width="10px">
                      <a href="{{ route('stockproducts.edit', $stockproduct->id) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                    </td>

                  </tr>
                  <!-- {{ $count = $count + 1 }} -->
                  @endforeach
                </tbody>

              </table>
              {{ $stockproducts->render() }}
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
