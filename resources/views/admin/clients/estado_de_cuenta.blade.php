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
            <li class="breadcrumb-item"><a href="{{ route('clients.index') }}">Clientes</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $client->name}}</li>
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
              <h3 class="card-title" >Estado de Cuenta</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <table class="table table-striped table-hover table-bordered">
                <thead>
                  <tr>
                    <th width="10px">Fecha</th>
                    <th>Tipo de Movimiento</th>
                    <th width="10px">Crédito</th>
                    <th width="10px">Débito</th>
                    <th width="10px">Saldo</th>
                    <th colspan="1">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($payments as $payment)
                  <tr>
                    <td>{{ $payment->created_at }}</td>
                    <td>Pago</td>
                    <td>{{ $payment->valor }}</td>
                    <td>{{ $payment->valor }}</td>
                    <td>{{ $payment->valor }}</td>
                    <td width="10px">
                      <a href="#" class="btn btn-sm btn-outline-secondary">Ver</a>
                    </td>


                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $payments->render() }}

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
