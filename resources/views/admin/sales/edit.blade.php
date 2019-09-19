@extends('layouts.starter')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <!-- /.content-header -->


  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <!-- Main row -->
      <div class="row pt-3">
        <div class="col-9">
          <div class="card">
            <div class="card-header d-flex justify-content-end">
              <h3 class="card-title flex-fill" >Editar Venta</h3>

              @foreach($sales_user as $sale_user)
                @if($sale_user->client != null)
                  @if($sale_user->id == $sale->id)
                    <a href="{{ route('sales.edit', $sale_user->id) }}" class="btn btn-sm btn-success mr-2">{{ $sale_user->client->name }}</a>
                  @else
                    <a href="{{ route('sales.edit', $sale_user->id) }}" class="btn btn-sm btn-outline-success mr-2">{{ $sale_user->client->name }}</a>
                  @endif
                @else
                  @if($sale_user->id == $sale->id)
                    <a href="{{ route('sales.edit', $sale_user->id) }}" class="btn btn-sm btn-primary mr-2">Cliente Estándar</a>
                  @else
                    <a href="{{ route('sales.edit', $sale_user->id) }}" class="btn btn-sm btn-outline-primary mr-2">Cliente Estándar</a>
                  @endif
                @endif
              @endforeach

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  {!! Form::open(['route' => ['sales.saleitems.store', $sale->id]]) !!}

                    <input id="saleproduct_barcode" name="saleproduct_barcode" type="text" class="form-control" >

                  {!! Form::close() !!}
                </div>

                <div class="col-sm-1 d-flex align-items-center">

                    <button type="button" class="btn btn-sm btn-success ml-2" data-toggle="modal" data-target="#selectSaleProductModal"> &nbsp; &nbsp;<i class="fas fa-cart-plus"></i> &nbsp; &nbsp; </button>

              </div>



              </div>




              <table class="table table-striped table-hover table-bordered mt-3">
                <thead>
                  <tr>
                    <th>Producto</th>
                    <th width="40px">Precio</th>
                    <th width="40px">Desc</th>
                    <th width="40px">P-Desc</th>
                    <th width="40px">Cantidad</th>
                    <th width="40px">Subtotal</th>
                    <th colspan="2">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>

                  <!-- {{ $count = 0 }} -->

                  @foreach($sale->saleItems as $item)
                  @if($id_edited == $item->id)
                  <tr class="table-warning">
                  @else
                  <tr>
                  @endif

                    <td>{{ $item->saleproduct->name }}</td>
                    <td style="text-align: right;">{{ number_format($item->precio, 4) }}</td>
                    <td style="text-align: right;">{{ number_format($item->descuento, 2) }}</td>
                    <td style="text-align: right;">{{ number_format($item->getPrecioDescuento(), 4) }}</td>
                    <td style="text-align: right;">{{ number_format($item->cantidad, 2) }}</td>
                    <td style="text-align: right;">{{ number_format($item->getSubTotal(), 2) }}</td>
                    <td width="10px">
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editarModalN{{ $count }}">
                        <i class="far fa-edit"></i>
                      </button>
                    </td>
                    <td width="10px">
                      {{ Form::open(['route' => ['sales.saleitems.destroy', $sale->id, $item->id], 'method' => 'DELETE']) }}
                        <button class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></button>
                      {{ Form::close() }}

                    </td>

                  </tr>
                  <!-- {{ $count = $count + 1 }} -->
                  @endforeach
                </tbody>
              </table>


              <div class="row">
                <div class="col-12 d-flex justify-content-end mt-3">

                  @if($sale->client != null)

                    {{ Form::open(['route' => ['sales.destroy', $sale->id], 'method' => 'DELETE']) }}
                    <button class="btn btn-sm btn-primary mr-3">Finalizar   </i></button>
                    {{ Form::close() }}
                  @endif

                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-sm btn-primary mr-3" data-toggle="modal" data-target="#medotoPagoModal">
                    Pagar
                  </button>


                    {{ Form::open(['route' => ['sales.destroy', $sale->id], 'method' => 'DELETE']) }}
                    <button class="btn btn-sm btn-danger">Cancelar   <i class="far fa-trash-alt"></i></button>
                    {{ Form::close() }}
                </div>

              </div>





            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

        <div class="col-3">


          <div class="card bg-dark" >


              <li class="list-group-item bg-dark">
                <input type="text" class="form-control form-disable text-sm-right total-value-edit text-success" value="$ {{ number_format($sale->getTotal(), 2) }}" disabled>
              </li>


          </div>

          <div class="card border-primary">
            <div class="card-header bg-primary">
              Cliente
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-10">
                  @if($sale->client != null)
                    <input type="text" name="nombre_cliente" class="form-control form-disable" value="{{ $sale->client->name }}" disabled >
                  @else
                    <input type="text" name="nombre_cliente" class="form-control mx-sm-3 form-disable" value="Cliente Estándar" disabled >
                  @endif
                </div>

                <div class="col-2 d-flex align-items-center justify-content-end">
                  @if($sale->client != null)
                    <a href="{{ route('clients.show', $sale->client->id) }}" target="_blank" class="btn btn-sm btn-outline-secondary"><i class="far fa-user"></i></a>
                  @else
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#selectClientModal"><i class="fas fa-search"></i></button>
                  @endif
                </div>

              </div>
            </div>
          </div>






        </div>

      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Select Saleproduct Modal -->
<div class="modal fade in" id="selectSaleProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-max-width" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLabel">Seleccionar un Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">

        <input type="text" class="form-controller" id="search" name="search"></input>

        </div>
        <table class="table table-bordered table-hover">
          <thead>
            <tr class="bg-primary">
              <th >ID</th>
              <th>Product Name</th>
              <th>Precio</th>
              <th>Stock</th>
              <th></th>
            </tr>
        </thead>
        <tbody id="tbody-select">

        </tbody>
      </table>
      </div>

    </div>
  </div>
</div>

<!-- Modal Cantidad -->
<div class="modal fade" id="cantidadModal" tabindex="-1" role="dialog" aria-labelledby="cantidadModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingrese la Cantidad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::open(['route' => ['sales.saleitems.store', $sale->id]]) !!}
      <div class="modal-body">


        {{ Form::hidden('sale_id', $sale->id) }}
        {{ Form::hidden('saleproduct_id', 0, ['id' => 'saleproduct_id']) }}
          <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" class="form-control text-right" step="any" name="cantidad" id="cantidad" value="1" >
          </div>


      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

<!-- Select Client Modal -->
<div class="modal fade" id="selectClientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">

        <input type="text" class="form-controller" id="search_client" name="search"></input>

        </div>
        {!! Form::model($sale, ['route' => ['sales.update_client', $sale->id], 'method' => 'POST']) !!}
        {{ Form::hidden('client_id', null, ['id' => 'id_client_input']) }}
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th></th>
            </tr>
        </thead>
        <tbody id="tbody-select_client">

        </tbody>
      </table>
      {!! Form::close() !!}
      </div>

    </div>
  </div>
</div>



<!-- {{ $count = 0 }} -->
@foreach($sale->saleitems as $item)
<!-- Editar SaleProducto Modal -->
<div class="modal fade" id="editarModalN{{ $count }}" tabindex="-1" role="dialog" aria-labelledby="editarModalN" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-max-width" role="document">
    <div class="modal-content">

      {!! Form::model($item, ['route' => ['sales.saleitems.update', $sale->id, $item->id], 'method' => 'PUT']) !!}

      <div class="modal-body">

        <table class="table table-striped table-hover table-bordered mt-3">
          <thead>
            <tr>
              <th>Producto</th>
              <th width="40px">Precio</th>
              <th width="40px">Desc</th>
              <th width="40px">P-Desc</th>
              <th width="40px">Cantidad</th>
              <th width="40px">Subtotal</th>
              <th colspan="1">&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{ $item->saleproduct->name }}</td>
              <td>
                <input style="text-align: right; width: 100px; " type="number" id="precio{{ $count }}" name="precio" value="{{ number_format($item->precio, 4) }}" step="any">
              </td>

              <td>
                <input style="text-align: right; width: 100px; " type="number" id="descuento{{ $count }}" name="descuento" value="{{ number_format($item->descuento, 2) }}" step="any">
              </td>

              <td style="text-align: right;"><span id="precio_descuento{{ $count }}">{{ number_format($item->getPrecioDescuento(), 4) }}</span></td>
              <td>
                <input style="text-align: right; width: 100px; " type="number" id="cantidad{{ $count }}" name="cantidad" value="{{ number_format($item->cantidad, 2) }}" step="any">
              </td>
              <td style="text-align: right;"><span id="subtotal{{ $count }}">{{ number_format($item->getSubTotal(), 2) }}</span></td>
              <td width="10px">
                <!-- Button trigger modal -->
                <button type="submit" class="btn btn-sm btn-success">
                  <i class="far fa-share-square"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      {!! Form::close() !!}
    </div>
  </div>
</div>

<!-- {{ $count = $count + 1 }} -->
@endforeach



<!--   Metodo de Pago Modal BEGIN ------------------>

<div class="modal fade" id="medotoPagoModal" tabindex="-1" role="dialog" aria-labelledby="medotoPagoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Métodos de Pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>



<!--   Metodo de Pago Modal END ------------------>



@push('scripts2')
<script type="text/javascript">


  $('#search').on('keyup',function(){
    $value=$(this).val();
    if($value != ''){
      $.ajax({
        type : 'get',
        url : '{{URL::to('sales_search_item')}}',
        @if($sale->client != null)
        data:{'search':$value, 'tipo':'{{ $sale->client->tipo }}'},
        @else
        data:{'search':$value, 'tipo':'Minorista'},
        @endif
        success:function(data){
          $('#tbody-select').html(data);
        }
      });
    }else{
      $('#tbody-select').html('');
    }

  });

  //add Item
  $('#cantidadModal').on('shown.bs.modal', function (e) {
    $('#cantidad').focus();
    $('#cantidad').select();

  });



  var id_selected = 0;

  function select(num){
    id_selected = num;
  }

  $('#selectSaleProductModal').on('shown.bs.modal', function (e) {
    $('#search').focus();

  });


  //Select Client

  function select_client(num){
    $('#id_client_input').val(num);
  }
  $('#selectClientModal').on('shown.bs.modal', function (e) {
    $('#search_client').focus();

  });

  $('#search_client').on('keyup',function(){
    $value=$(this).val();
    if($value != ''){
      $.ajax({
        type : 'get',
        url : '{{URL::to('sales_search_client')}}',
        data:{'search':$value},
        success:function(data){
          $('#tbody-select_client').html(data);
        }
      });
    }else{
      $('#tbody-select_client').html('');
    }

  });



  $(document).ready(function(){

    $('#selectSaleProductModal').on('hidden.bs.modal', function (e) {

      if(id_selected != 0){
        $('#cantidadModal').modal('show');
        $('#saleproduct_id').val(id_selected);

      }
      //alert(id_selected);

    });

    $('#saleproduct_barcode').focus();



  })



</script>

<!-- {{ $count = 0 }} -->
@foreach($sale->saleitems as $item)
<script type="text/javascript">
  $('#editarModalN{{ $count }}').on('shown.bs.modal', function(){

    $('#cantidad{{ $count }}').select();
    $('#cantidad{{ $count }}').focus();

  });

  $(document).ready(function(){
    setTimeout(function() {$('tr').removeClass("table-warning"); }, 3000);

    $("#cantidad{{ $count }}").keyup(function() {
      var precio = $("#precio{{ $count }}").val();
      var descuento = $("#descuento{{ $count }}").val();
      var cantidad = $("#cantidad{{ $count }}").val();

      var precio_descuento = precio * ( 1 - descuento / 100);

      $("#subtotal{{ $count }}").html((precio_descuento * cantidad).toFixed(2));
    });

    $("#precio{{ $count }}").keyup(function() {
      var precio = $("#precio{{ $count }}").val();
      var descuento = $("#descuento{{ $count }}").val();
      var cantidad = $("#cantidad{{ $count }}").val();

      var precio_descuento = precio * ( 1 - descuento / 100);

      $("#precio_descuento{{ $count }}").html((precio_descuento).toFixed(4));

      $("#subtotal{{ $count }}").html((precio_descuento * cantidad).toFixed(2));
    });

    $("#descuento{{ $count }}").keyup(function() {
      var precio = $("#precio{{ $count }}").val();
      var descuento = $("#descuento{{ $count }}").val();
      var cantidad = $("#cantidad{{ $count }}").val();

      var precio_descuento = precio * ( 1 - descuento / 100);

      $("#precio_descuento{{ $count }}").html((precio_descuento).toFixed(4));

      $("#subtotal{{ $count }}").html((precio_descuento * cantidad).toFixed(2));
    });



  });
</script>
<!-- {{ $count = $count + 1 }} -->
@endforeach

@endpush

@endsection
