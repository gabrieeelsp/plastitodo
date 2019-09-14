@extends('layouts.starter')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Ventas</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ventas</li>
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
              <h3 class="card-title" >Lista de Ventas</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @include('admin.sales.partials.search')
              <table class="table table-hover table-bordered">
                <thead class="bg-primary">
                  <tr>
                    <th width="10px">ID</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Usuario</th>
                    <th width="10px">Total</th>
                    <th colspan="1">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- {{ $count = 0 }} -->
                  @foreach($sales as $sale)
                  <tr>
                    <td>{{ $sale->id }}</td>
                    <td>{{ Carbon\Carbon::parse($sale->created_at)->format('d-m-Y H:i') }}</td>
                    <td>{{ $sale->client->name }}</td>
                    <td>{{ $sale->user->name }}</td>
                    <td style="text-align: right;">{{ number_format($sale->getTotal(), 2)}}</td>
                    <td width="10px">
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#editarModalN{{ $count }}">
                        Ver
                      </button>
                    </td>


                  </tr>
                  <!-- {{ $count = $count + 1 }} -->
                  @endforeach
                </tbody>
              </table>
              {{ $sales->appends(['searchText' => $searchText, 'daterange' => $daterange])->links() }}

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

<!-- {{ $count = 0 }} -->
@foreach($sales as $sale)
<!-- Editar Producto Modal -->
<div class="modal fade" id="editarModalN{{ $count }}" tabindex="-1" role="dialog" aria-labelledby="editarModalN" aria-hidden="true">
  <div class="modal-dialog modal-dialog-max-width modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Venta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-sm-4">
            <div class="row">
              <label for="cliente" class="col-sm-2 col-form-label text-sm-right">Cliente</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control form-disable col-sm-10" value="{{ $sale->client->name }}" disabled>
              </div>
            </div>
            <div class="row">
              <label for="cliente" class="col-sm-2 col-form-label text-sm-right">Fecha</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control form-disable col-sm-10" value="{{ Carbon\Carbon::parse($sale->created_at)->format('d-m-Y H:i') }}" disabled>
              </div>
            </div>
          </div>


          <div class="col-sm-4">

            <div class="row">
              <label for="user" class="col-sm-2 col-form-label text-sm-right">Usuario</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control form-disable col-sm-10" value="{{ $sale->user->name }}" disabled>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="form-group row">
              <label for="cliente" class="col-sm-4 col-form-label text-sm-right">TOTAL</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control form-disable text-sm-right total-value text-primary" value="${{ $sale->getTotal() }}" disabled>
              </div>
            </div>
          </div>
        </div>

          <table class="table table-hover">
            <thead>
              <tr>
                <th width="10px">ID</th>
                <th>Producto</th>
                <th width="10px">Precio</th>
                <th width="10px">Cantidad</th>
                <th width="10px">SubTotal</th>

              </tr>
            </thead>
            <tbody>

              @foreach($sale->saleitems as $item)
              <tr>
                <td>{{ $item->saleproduct->id }}</td>
                <td>{{ $item->saleproduct->name }}</td>
                <td width="10px" style="text-align: right;">{{ $item->precio }}</td>
                <td width="10px" style="text-align: right;">{{ $item->cantidad }}</td>
                <td width="10px" style="text-align: right;"><b>{{ number_format($item->getSubTotal(), 4)  }}</b></td>




              </tr>

              @endforeach
            </tbody>
          </table>




      </div>
      <div class="modal-footer">


      </div>

    </div>
  </div>
</div>

<!-- {{ $count = $count + 1 }} -->
@endforeach

@push('scripts')

@endpush
@endsection
