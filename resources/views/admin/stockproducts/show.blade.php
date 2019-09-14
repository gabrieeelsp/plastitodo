@extends('layouts.starter')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Productos Stock</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stockproducts.index') }}">Productos Stock</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $stockproduct->name}}</li>
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
              <h3 class="card-title" >Ver Producto Stock</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <p><strong>Nombre:</strong> {{ $stockproduct->name }}</p>
              <p><strong>Slug:</strong> {{ $stockproduct->slug }}</p>
              <p><strong>Categoría:</strong> {{ $stockproduct->category->name }}</p>
              <p><strong>Stock:</strong> {{ $stockproduct->stock }}</p>
              <p><strong>Costo:</strong> {{ $stockproduct->costo }}</p>
              <a class="nav-link" href="{{ route('stockproducts.saleproducts.index', $stockproduct->id) }}">Productos Venta</a>
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
@endsection
