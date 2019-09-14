@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Inicio</a></li>
          <li class="breadcrumb-item active" aria-current="page">Productos Stock</li>
        </ol>
      </nav>
      <div id="fondo">
        fonco
      </div>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          Lista de Productos Stock
          <a href="{{ route('stockproducts.create') }}" class="btn btn-sm btn-primary">Nuevo</a>
        </div>
        <div class="card-body">
          @include('admin.stockproducts.partials.search')
          <table class="table table-striped table-hover table-bordered">
            <thead>
              <tr>
                <th width="10px">ID</th>
                <th>Nombre</th>
                <th width="10px">Costo</th>
                <th colspan="4">&nbsp;</th>
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
                <td width="10px">
                  <a href="{{ route('stockproducts.show', $stockproduct->id) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                </td>
                <td width="10px">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#editarModalN{{ $count }}">
                    E-Costo
                  </button>
                </td>
                <td width="10px">
                  <a href="{{ route('stockproducts.edit', $stockproduct->id) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                </td>
                <td width="10px">
                  <a href="{{ route('stockproducts.saleproducts.index', $stockproduct->id) }}" class="btn btn-sm btn-success">P-Venta</a>
                </td>
                <!--
                <td width="10px">
                  {{ Form::open(['route' => ['stockproducts.destroy', $stockproduct->id], 'method' => 'DELETE']) }}
                    <button class="btn btn-sm btn-danger">Eliminar</button>
                  {{ Form::close() }}
                </td>
              -->
              </tr>
              <!-- {{ $count = $count + 1 }} -->
              @endforeach
            </tbody>
          </table>
          {{ $stockproducts->render() }}
        </div>
      </div>
    </div>
  </div>
</div>

<!-- {{ $count = 0 }} -->
@foreach($stockproducts as $stockproduct)
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
      {!! Form::open(['route' => ['stockproducts.update_costo', $stockproduct->id], 'method' => 'POST']) !!}
      <div class="modal-body">

          {{ Form::hidden('searchText', $searchText) }}

          <div class="form-group">
            {{ Form::label('costo', 'COSTO [ '. $stockproduct->name .' ]', ['class' => 'mr-2 ml-2']) }}
            {{ Form::number('costo', null, ['class' => 'form-control text-right', 'step' => 'any', 'id' => 'costo' . $count]) }}
          </div>

          <div class="form-check">

            @if ($stockproduct->stockproductgroup_id == null)
                <input class="form-check-input"  type="checkbox" name="update_grupo" id="updateGroupCheck1" disabled >
                <label class="form-check-label" for="updateGroupCheck1">
                  Actualizar Grupo
                </label>
            @else
                <input class="form-check-input"  type="checkbox" name="update_grupo" id="updateGroupCheck1" checked >
                <label class="form-check-label" for="updateGroupCheck1">
                  Actualizar Grupo ( {{ $stockproduct->stockproductgroup->name }} )
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

<!-- {{ $count = 0 }} -->
@foreach($stockproducts as $stockproduct)
<script type="text/javascript">
  $('#editarModalN{{ $count }}').on('shown.bs.modal', function(){
    $('#costo{{ $count }}').val('');
    $('#costo{{ $count }}').focus();
  })

  $(document).ready(function(){
    setTimeout(function() {$('tr').removeClass("table-primary"); }, 3000);
  });
</script>
<!-- {{ $count = $count + 1 }} -->
@endforeach
@endsection
