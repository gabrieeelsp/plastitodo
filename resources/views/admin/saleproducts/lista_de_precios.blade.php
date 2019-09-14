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
            <li class="breadcrumb-item active" aria-current="page">Lista de Productos Venta</li>
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
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @include('admin.saleproducts.partials.search_lista_de_precios')
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th width="10px">ID</th>
                    <th>Nombre</th>
                    <th>Costo</th>
                    <th>P-Min</th>
                    <th>P-May</th>
                    <th colspan="1">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- {{ $count = 0 }} -->
                  @foreach($saleproducts as $saleproduct)
                  @if(in_array($saleproduct->id, $selectedItems))
                  <tr class="table-success">
                  @else
                  <tr>
                  @endif
                    <td>{{ $saleproduct->id }}</td>
                    <td>{{ $saleproduct->name }}</td>
                    <td width="10px" style="text-align: right;">{{ number_format($saleproduct->getCosto(), 4)  }}</td>
                    <td width="10px" style="text-align: right;">{{ number_format($saleproduct->getPrecioMin(), 4)  }}</td>
                    <td width="10px" style="text-align: right;">{{ number_format($saleproduct->getPrecioMay(), 4)  }}</td>

                    <td width="10px">
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#editarModalN{{ $count }}">
                        E-Costo
                      </button>
                    </td>

                  </tr>
                  <!-- {{ $count = $count + 1 }} -->
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

<!-- {{ $count = 0 }} -->
@foreach($saleproducts as $saleproduct)
<!-- Editar Producto Modal -->
<div class="modal fade" id="editarModalN{{ $count }}" tabindex="-1" role="dialog" aria-labelledby="editarModalN" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Editar Costo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      {!! Form::model($saleproduct, ['route' => ['saleproducts.lista_de_precios.update_valores', $saleproduct->id]]) !!}
      <div class="modal-body">
        <h5>{{ $saleproduct->name }}</h5>
          {{ Form::hidden('searchText', $searchText) }}

          <div class="form-group">
            {{ Form::label('costo', 'Costo', ['class' => 'mr-2 ml-2']) }}
            <input type="text" name="costo" value="{{ number_format($saleproduct->getCosto(), 4)  }}" class="form-control text-right" step="any" disabled>

          </div>

          <div class="form-group">
            {{ Form::label('porc_min', 'Porc MIN', ['class' => 'mr-2 ml-2']) }}
            {{ Form::number('porc_min', null, [ 'class' => 'form-control text-right', 'step' => 'any', 'id' => 'porc_min' . $count]) }}
          </div>
          <div class="form-group">
            {{ Form::label('precio_min', 'Precio MIN', ['class' => 'mr-2 ml-2']) }}
            {{ Form::number('precio_min', null, [ 'class' => 'form-control text-right', 'step' => 'any', 'id' => 'precio_min' . $count]) }}
          </div>
          <div class="form-group">
            {{ Form::label('porc_may', 'Porc MAY', ['class' => 'mr-2 ml-2']) }}
            {{ Form::number('porc_may', null, [ 'class' => 'form-control text-right', 'step' => 'any', 'id' => 'porc_may' . $count]) }}
          </div>
          <div class="form-group">
            {{ Form::label('precio_may', 'Precio MAY', ['class' => 'mr-2 ml-2']) }}
            {{ Form::number('precio_may', null, [ 'class' => 'form-control text-right', 'step' => 'any', 'id' => 'precio_may' . $count]) }}
          </div>

          <div class="form-check">

            @if ($saleproduct->saleproductgroup_id == null)
                <input class="form-check-input"  type="checkbox" name="update_grupo" id="update_grupoCheck1" disabled >
                <label class="form-check-label" for="update_grupo">
                  Actualizar Grupo
                </label>
            @else
                <input class="form-check-input"  type="checkbox" name="update_grupo" id="update_grupoCheck1" checked >
                <label class="form-check-label" for="update_grupo">
                  Actualizar Grupo ( {{ $saleproduct->saleproductgroup->name }} )
                </label>
            @endif


          </div>


      </div>
      <div class="modal-footer">

        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

<!-- {{ $count = $count + 1 }} -->
@endforeach


@push('scripts')
<!-- {{ $count = 0 }} -->
@foreach($saleproducts as $saleproduct)

<script type="text/javascript">
  $('#editarModalN{{ $count }}').on('shown.bs.modal', function(){


    var value = $("#porc_min{{ $count }}").val();
    var precio_min = {{ $saleproduct->getcosto() }} * ( 1 + ( value / 100));
    $("#precio_min{{ $count }}").val(precio_min.toFixed(4) );

    var value_may = $("#porc_may{{ $count }}").val();
    var precio_may = {{ $saleproduct->getCosto() }} * ( 1 + ( value_may / 100));
    $("#precio_may{{ $count }}").val(precio_may.toFixed(4) );

    $('#precio_min{{ $count }}').select();
    $('#precio_min{{ $count }}').focus();

  });

  $(document).ready(function(){
    setTimeout(function() {$('tr').removeClass("table-success"); }, 3000);

    $('#editarModalN{{ $count }}').on('change', function(){

    });

    $("#porc_min{{ $count }}").keyup(function() {
      var value = $("#porc_min{{ $count }}").val();
      var precio_min = {{ $saleproduct->getCosto() }} * ( 1 + ( value / 100));
      $("#precio_min{{ $count }}").val(precio_min.toFixed(4) );
    });

    $("#precio_min{{ $count }}").keyup(function() {
      var value = $("#precio_min{{ $count }}").val();
      var porc_min = ((value / {{ $saleproduct->getCosto() }}) - 1) * 100;
      $("#porc_min{{ $count }}").val(porc_min.toFixed(4) );
    });

    $("#porc_may{{ $count }}").keyup(function() {
      var value = $("#porc_may{{ $count }}").val();
      var precio_may = {{ $saleproduct->getCosto() }} * ( 1 + ( value / 100));
      $("#precio_may{{ $count }}").val(precio_may.toFixed(4) );
    });

    $("#precio_may{{ $count }}").keyup(function() {
      var value = $("#precio_may{{ $count }}").val();
      var porc_may = ((value / {{ $saleproduct->getCosto() }}) - 1) * 100;
      $("#porc_may{{ $count }}").val(porc_may.toFixed(4) );
    });


  });
</script>
<!-- {{ $count = $count + 1 }} -->
@endforeach
@endpush
@endsection
