@extends('layouts.starter')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Proveedores</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Proveedores</li>
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
              <h3 class="card-title" >Lista de Proveedors</h3>
              <a href="{{ route('proveedors.create') }}" class="btn btn-sm btn-primary" style="float:right;">Nuevo</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @include('admin.proveedors.partials.search')
              <table class="table table-striped table-hover table-bordered">
                <thead>
                  <tr>
                    <th width="10px">ID</th>
                    <th>Nombre</th>
                    <th colspan="3">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($proveedors as $proveedor)
                  <tr>
                    <td>{{ $proveedor->id }}</td>
                    <td>{{ $proveedor->name }}</td>
                    <td width="10px">
                      <a href="{{ route('proveedors.show', $proveedor->id) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                    </td>
                    <td width="10px">
                      <a href="{{ route('proveedors.edit', $proveedor->id) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                    </td>
                    <td width="10px">
                      <a href="{{ route('proveedors.purchaseproducts.index', $proveedor->id) }}" class="btn btn-sm btn-success">P-Compra</a>
                    </td>
                    <!--
                    <td width="10px">
                      {{ Form::open(['route' => ['proveedors.destroy', $proveedor->id], 'method' => 'DELETE']) }}
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                      {{ Form::close() }}
                    </td>
                  -->
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $proveedors->render() }}

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
