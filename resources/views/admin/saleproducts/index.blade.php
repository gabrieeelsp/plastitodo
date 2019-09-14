@extends('layouts.starter')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Productos Venta</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stockproducts.index') }}">Productos Stock</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stockproducts.edit', $stockproduct->id) }}">{{ $stockproduct->name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Productos Venta</li>
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
              <h3 class="card-title" >Lista de Productos Venta</h3>
              <a href="{{ route('stockproducts.saleproducts.create', $stockproduct->id) }}" class="btn btn-sm btn-primary">Nuevo</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @include('admin.saleproducts.partials.search')
              <table class="table table-striped table-hover table-bordered">
                <thead>
                  <tr>
                    <th width="10px">ID</th>
                    <th>Nombre</th>
                    <th colspan="1">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($saleproducts as $saleproduct)
                  <tr>
                    <td>{{ $saleproduct->id }}</td>
                    <td>{{ $saleproduct->name }}</td>
                    <!--
                    <td width="10px">
                      <a href="{{ route('stockproducts.saleproducts.show', [$stockproduct->id, $saleproduct->id]) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                    </td>
                  -->
                    <td width="10px">
                      <a href="{{ route('stockproducts.saleproducts.edit', [$stockproduct->id, $saleproduct->id]) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                    </td>
                    <!--
                    <td width="10px">
                      {{ Form::open(['route' => ['stockproducts.saleproducts.destroy', $stockproduct->id, $saleproduct->id], 'method' => 'DELETE']) }}
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                      {{ Form::close() }}
                    </td>
                  -->
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $saleproducts->render() }}

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
