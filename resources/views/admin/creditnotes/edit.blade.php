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
              <h3 class="card-title flex-fill" >Editar Note de Crédito</h3>

              @foreach($creditnotes_user as $creditnote_user)
                @if($creditnote_user->client != null)
                  @if($creditnote_user->id == $creditnote->id)
                    <a href="{{ route('creditnotes.edit', $creditnote_user->id) }}" class="btn btn-sm btn-success mr-2">{{ $creditnote_user->client->name }}</a>
                  @else
                    <a href="{{ route('creditnotes.edit', $creditnote_user->id) }}" class="btn btn-sm btn-outline-success mr-2">{{ $creditnote_user->client->name }}</a>
                  @endif
                @else
                  @if($creditnote_user->id == $creditnote->id)
                    <a href="{{ route('creditnotes.edit', $creditnote_user->id) }}" class="btn btn-sm btn-primary mr-2">Cliente Estándar</a>
                  @else
                    <a href="{{ route('creditnotes.edit', $creditnote_user->id) }}" class="btn btn-sm btn-outline-primary mr-2">Cliente Estándar</a>
                  @endif
                @endif
              @endforeach

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  {!! Form::open(['route' => ['creditnotes.creditnoteitems.store', $creditnote->id]]) !!}

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
                    <th width="40px">Retornar</th>
                    <th width="40px">Subtotal</th>
                    <th colspan="2">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>

                  <!-- {{ $count = 0 }} -->

                  @foreach($creditnote->creditnoteitems as $item)
                  @if($id_edited == $item->id)
                  <tr class="table-warning">
                  @else
                  <tr>
                  @endif

                    <td>{{ $item->saleproduct->name }}</td>
                    <td style="text-align: right;">{{ number_format($item->precio, 2) }}</td>
                    <td style="text-align: right;">{{ number_format($item->descuento, 2) }}</td>
                    <td style="text-align: right;">{{ number_format($item->getPrecioDescuento(), 2) }}</td>
                    <td style="text-align: right;">{{ number_format($item->cantidad, 2) }}</td>
                    <td>{{ $item->retornar_stock }}</td>
                    <td style="text-align: right;">{{ number_format($item->getSubTotal(), 2) }}</td>
                    <td width="10px">
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editarModalN{{ $count }}">
                        <i class="far fa-edit"></i>
                      </button>
                    </td>
                    <td width="10px">
                      {{ Form::open(['route' => ['creditnotes.creditnoteitems.destroy', $creditnote->id, $item->id], 'method' => 'DELETE']) }}
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



                  @if($creditnote->client != null)

                    {{ Form::open(['route' => ['creditnotes.destroy', $creditnote->id], 'method' => 'DELETE']) }}
                    <button class="btn btn-sm btn-primary mr-3">Finalizar   </i></button>
                    {{ Form::close() }}
                  @endif



                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-sm btn-primary mr-3" data-toggle="modal" data-target="#medotoPagoEfectivoModal"
                    @if($creditnote->getTotal() == 0) disabled @endif
                    >
                    Pago EFECTIVO
                  </button>


                    {{ Form::open(['route' => ['creditnotes.destroy', $creditnote->id], 'method' => 'DELETE']) }}
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
                <input type="text" class="form-control form-disable text-sm-right total-value-edit text-success" value="$ {{ number_format($creditnote->getTotal(), 2) }}" disabled>
              </li>


          </div>

          <div class="card border-primary">
            <div class="card-header bg-primary">
              Cliente
            </div>
            <div class="card-body">
              <div class="row">

                <div class="col-10 d-flex justify-content-start">
                  @if($creditnote->client != null)
                    <input type="text" name="nombre_cliente" class="form-control form-disable" value="{{ $creditnote->client->name }}" disabled >
                  @else
                    <input type="text" name="nombre_cliente" class="form-control mx-sm-3 form-disable" value="Cliente Estándar" disabled >
                  @endif
                </div>

                <div class="col-2 d-flex align-items-center justify-content-end">
                  @if($creditnote->client != null)

                    <a href="{{ route('clients.show', $creditnote->client->id) }}" target="_blank" class="btn btn-sm btn-outline-secondary"><i class="far fa-user"></i></a>
                  @else
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#selectClientModal"><i class="fas fa-search"></i></button>
                  @endif
                </div>

              </div>
              <div class="row">

                <div class="col-12 d-flex">

                  {{ Form::open(['route' => ['creditnotes.set_tipo_comprobante', $creditnote->id], 'method' => 'POST']) }}
                  {{ Form::hidden('tipo_comprobante', '0') }}
                  @if($creditnote->tipo_comprobante == null)
                  <button class="btn btn-sm btn-success">--------</i></button>
                  @else
                  <button class="btn btn-sm btn-outline-success">--------</i></button>
                  @endif
                  {{ Form::close() }}

                  @if(in_array('TZ', $comprobantes) || $creditnote->client == null)
                    {{ Form::open(['route' => ['creditnotes.set_tipo_comprobante', $creditnote->id], 'method' => 'POST']) }}
                    {{ Form::hidden('tipo_comprobante', 'TZ') }}
                    @if($creditnote->tipo_comprobante == 'TZ')
                    <button class="btn btn-sm btn-success">Ticket</i></button>
                    @else
                    <button class="btn btn-sm btn-outline-success">Ticket</i></button>
                    @endif
                    {{ Form::close() }}
                  @endif


                  @if(in_array('A', $comprobantes))
                    {{ Form::open(['route' => ['creditnotes.set_tipo_comprobante', $creditnote->id], 'method' => 'POST']) }}
                    {{ Form::hidden('tipo_comprobante', 'A') }}
                    @if($creditnote->tipo_comprobante == 'A')
                    <button class="btn btn-sm btn-success">Factura A</i></button>
                    @else
                    <button class="btn btn-sm btn-outline-success">Factura A</i></button>
                    @endif
                    {{ Form::close() }}
                  @endif


                  @if(in_array('B', $comprobantes))
                    {{ Form::open(['route' => ['creditnotes.set_tipo_comprobante', $creditnote->id], 'method' => 'POST']) }}
                    {{ Form::hidden('tipo_comprobante', 'B') }}
                    @if($creditnote->tipo_comprobante == 'B')
                    <button class="btn btn-sm btn-success">Factura B</i></button>
                    @else
                    <button class="btn btn-sm btn-outline-success">Factura B</i></button>
                    @endif
                    {{ Form::close() }}
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
      {!! Form::open(['route' => ['creditnotes.creditnoteitems.store', $creditnote->id]]) !!}
      <div class="modal-body">


        {{ Form::hidden('creditnote_id', $creditnote->id) }}
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





<!-- {{ $count = 0 }} -->
@foreach($creditnote->creditnoteitems as $item)
<!-- Editar SaleProducto Modal -->
<div class="modal fade" id="editarModalN{{ $count }}" tabindex="-1" role="dialog" aria-labelledby="editarModalN" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-max-width" role="document">
    <div class="modal-content">

      {!! Form::model($item, ['route' => ['creditnotes.creditnoteitems.update', $creditnote->id, $item->id], 'method' => 'PUT']) !!}

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
                <input style="text-align: right; width: 100px; " type="text" id="precio{{ $count }}" name="precio" value="{{ number_format($item->precio, 2) }}" step="any">
              </td>

              <td>
                <input style="text-align: right; width: 100px; " type="number" id="descuento{{ $count }}" name="descuento" value="{{ number_format($item->descuento, 2) }}" step="any">
              </td>

              <td style="text-align: right;"><span id="precio_descuento{{ $count }}">{{ number_format($item->getPrecioDescuento(), 4) }}</span></td>
              <td>
                <input style="text-align: right; width: 100px; " type="text" id="cantidad{{ $count }}" name="cantidad" value="{{ number_format($item->cantidad, 2) }}" step="any">
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



<!--   Metodo de Pago EFECTIVO Modal BEGIN ------------------>

<div class="modal fade" id="medotoPagoEfectivoModal" tabindex="-1" role="dialog" aria-labelledby="medotoPagoEfectivoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Métodos de Pago: Efectivo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::model($creditnote, ['route' => ['creditnotes.guardar', $creditnote->id], 'method' => 'POST']) !!}

        <div class="form-group row">
          <label for="total_efectivo" class="col-sm-3 col-form-label text-sm-right">TOTAL</label>
          <div class="col-sm-9">
            <input type="text" readonly class="form-control text-sm-right" id="total_efectivo" value="{{ number_format($creditnote->getTotal(), 2) }}" >
          </div>
        </div>
        <div class="form-group row">
          <label for="entrega_efectivo" class="col-sm-3 col-form-label text-sm-right">Entrega</label>
          <div class="col-sm-9">
            <input type="text" class="form-control text-sm-right" id="entrega_efectivo" value="{{ number_format($creditnote->getTotal(), 2) }}"

            >
          </div>
        </div>
        <div class="form-group row">
          <label for="vuelto_efectivo" class="col-sm-3 col-form-label text-sm-right">Vuelto</label>
          <div class="col-sm-9">
            <input type="text" disabled class="form-control text-sm-right " id="vuelto_efectivo" name="vuelto_efectivo" value="0.00">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-12 d-flex justify-content-end">
              <button type="submit" class="btn btn-sm btn-success">Confirmar PAGO <i class="fas fa-check"></i></button>
          </div>
        </div>

        {!! Form::close() !!}




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
        @if($creditnote->client != null)
        data:{'search':$value, 'tipo':'{{ $creditnote->client->tipo }}'},
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
        url : '{{URL::to('search_client')}}',
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
@foreach($creditnote->creditnoteitems as $item)
<script type="text/javascript">
  $('#editarModalN{{ $count }}').on('shown.bs.modal', function(){

    $('#cantidad{{ $count }}').select();
    $('#cantidad{{ $count }}').focus();

  });

  $(document).ready(function(){
    setTimeout(function() {$('tr').removeClass("table-warning"); }, 3000);

    $("#cantidad{{ $count }}").keyup(function() {

      var precio = $("#precio{{ $count }}").val().replace(',','');
      precio = Number(precio);

      var cantidad = $("#cantidad{{ $count }}").val().replace(',','');
      cantidad = Number(cantidad);

      var descuento = $("#descuento{{ $count }}").val().replace(',','');
      descuento = Number(descuento);



      var precio_descuento = precio * ( 1 - descuento / 100);

      $("#subtotal{{ $count }}").html((precio_descuento * cantidad).toFixed(2));
    });

    $("#precio{{ $count }}").keyup(function() {
      var precio = $("#precio{{ $count }}").val().replace(',','');
      precio = Number(precio);

      var cantidad = $("#cantidad{{ $count }}").val().replace(',','');
      cantidad = Number(cantidad);

      var descuento = $("#descuento{{ $count }}").val().replace(',','');
      descuento = Number(descuento);

      var precio_descuento = precio * ( 1 - descuento / 100);

      $("#precio_descuento{{ $count }}").html((precio_descuento).toFixed(4));

      $("#subtotal{{ $count }}").html((precio_descuento * cantidad).toFixed(2));
    });

    $("#descuento{{ $count }}").keyup(function() {
      var precio = $("#precio{{ $count }}").val().replace(',','');
      precio = Number(precio);

      var cantidad = $("#cantidad{{ $count }}").val().replace(',','');
      cantidad = Number(cantidad);

      var descuento = $("#descuento{{ $count }}").val().replace(',','');
      descuento = Number(descuento);

      var precio_descuento = precio * ( 1 - descuento / 100);

      $("#precio_descuento{{ $count }}").html((precio_descuento).toFixed(4));

      $("#subtotal{{ $count }}").html((precio_descuento * cantidad).toFixed(2));
    });



  });

  //--------- PAGO EFECTIVO MODAL

  $('#medotoPagoEfectivoModal').on('shown.bs.modal', function (e) {
    $('#entrega_efectivo').select();
    $('#entrega_efectivo').focus();

  });
  $(document).ready(function(){
  $("#entrega_efectivo").keyup(function() {

    var total_efectivo = $("#total_efectivo").val().replace(',','');

    total_efectivo = Number(total_efectivo);


    var entrega_efectivo = $("#entrega_efectivo").val();

    var vuelto_efectivo = (total_efectivo - entrega_efectivo)  * (-1);

    $("#vuelto_efectivo").val((vuelto_efectivo).toFixed(2));

    if(vuelto_efectivo < 0){
      $("#vuelto_efectivo").addClass("border-danger");
    }else{
      $("#vuelto_efectivo").removeClass("border-danger");
    }
  });
});

</script>
<!-- {{ $count = $count + 1 }} -->
@endforeach

@endpush

@endsection
