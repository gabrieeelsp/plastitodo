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
            <div class="card-header d-flex justify-content-end">
              <h3 class="card-title  flex-fill" >Ver Cliente</h3>

              <a href="{{ route('debitnotes.create', ['client_id' => $client->id]) }}" class="btn btn-sm btn-success mr-2">Nueva Nota de Débito</a>
              <a href="{{ route('creditnotes.create', ['client_id' => $client->id]) }}" class="btn btn-sm btn-success mr-2">Nueva Nota de Crédito</a>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <p><strong>Nombre:</strong> {{ $client->name }}</p>
              <p><strong>Slug:</strong> {{ $client->slug }}</p>
              @include('admin.clients.partials.search_cuenta')
              <table class="table table-striped table-hover table-bordered">
                <thead>
                  <tr>
                    <th >Fecha</th>
                    <th>Tipo de Movimiento</th>
                    <th>Comprobante</th>
                    <th width="10px">Crédito</th>
                    <th width="10px">Débito</th>
                    <th width="10px">Saldo</th>
                    <th colspan="1">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach($rows as $row)
                  <tr>
                    <td >{{ $row->created_at }}</td>
                    <td >
                      @if($row->tipo === 1)
                      RECIBO
                      @elseif($row->tipo === 2)
                      VENTA
                      @elseif($row->tipo === 3)
                      NOTA DE CREDITO
                      @endif
                    </td>
                    <td style="text-align: right;">
                      @if($row->tipo === 1)

                      @elseif($row->tipo === 2)
                      @if($sales_only[$row->id]->fccomprobante != null)
                        {{ $sales_only[$row->id]->fccomprobante->tipo.' - '.$sales_only[$row->id]->fccomprobante->numero  }}
                      @endif
                      @elseif($row->tipo === 3)
                        @if($creditnotes_only[$row->id]->nccomprobante != null)
                          {{ $creditnotes_only[$row->id]->nccomprobante->tipo.' - '.$creditnotes_only[$row->id]->nccomprobante->numero  }}
                        @endif
                      @endif
                    </td>
                    <td style="text-align: right;">
                      @if($row->tipo === 1)

                      @elseif($row->tipo === 2)
                      {{ number_format($sales_only[$row->id]->total, 2)  }}
                      @elseif($row->tipo === 3)

                      @endif
                    </td>
                    <td style="text-align: right;">
                      @if($row->tipo === 1)
                      {{ number_format($payments_only[$row->id]->valor, 2)  }}
                      @elseif($row->tipo === 2)

                      @elseif($row->tipo === 3)
                      {{ number_format($creditnotes_only[$row->id]->total, 2)  }}
                      @endif
                    </td>

                    <td style="text-align: right;">
                      @if($row->tipo === 1)
                      {{ number_format($payments_only[$row->id]->saldo, 2)  }}
                      @elseif($row->tipo === 2)
                      {{ number_format($sales_only[$row->id]->saldo, 2)  }}
                      @elseif($row->tipo === 3)
                      {{ number_format($creditnotes_only[$row->id]->saldo, 2)  }}
                      @endif
                    </td>
                    <td width="10px">
                      <!-- Button trigger modal -->
                      @if($row->tipo == 2)
                      <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#verSaleModalN{{ $row->id }}">Ver</button>
                      @else
                      <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#verPaymentModalN{{ $row->id  }}">Ver</button>
                      @endif
                    </td>



                  </tr>
                  @endforeach

                </tbody>
              </table>
              {{ $rows->appends(['daterange' => $daterange])->links() }}

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



@foreach($sales_only as $sale)
<!-- Editar Producto Modal -->
<div class="modal fade" id="verSaleModalN{{ $sale->id }}" tabindex="-1" role="dialog" aria-labelledby="editarModalN" aria-hidden="true">
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
                  @if($sale->client != null)
                  <input type="text" class="form-control form-disable col-sm-10" value="{{ $sale->client->name }}" disabled>
                  @else
                  <input type="text" class="form-control form-disable col-sm-10" value="Cliente Estándar" disabled>
                  @endif
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

@endforeach
@endsection
