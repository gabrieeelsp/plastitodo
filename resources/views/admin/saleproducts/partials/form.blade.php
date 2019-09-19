<div class="row">
  <div class="col-md-8">
    <div class="form-group row">
      {{ Form::label('name', 'Nombre', ['class' => 'col-sm-2 col-form-label text-sm-right']) }}
      <div class="col-sm-10">
          {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
      </div>
    </div>
    <div class="form-group row">
      {{ Form::label('slug', 'URL Amigable', ['class' => 'col-sm-2 col-form-label text-sm-right']) }}
      <div class="col-sm-10">
          {{ Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug']) }}
      </div>
    </div>
    <div class="form-group row">
      {{ Form::label('saleproductgroup_id', 'Grupo P-Venta', ['class' => 'col-sm-2 col-form-label text-sm-right']) }}
      <div class="col-sm-10 d-flex align-items-center">
          {{ Form::select('saleproductgroup_id', $saleproductgroups, null, ['class' => 'form-control', 'id' => 'select2', 'placeholder' => '** Seleccionar un grupo']) }}
      </div>
    </div>
    <div class="form-group row">
      {{ Form::label('rel_venta_stock', 'Relacion Venta Stock', ['class' => 'col-sm-2 col-form-label text-sm-right']) }}
      <div class="col-sm-10">
          {{ Form::number('rel_venta_stock', null, ['class' => 'form-control text-right', 'step' => 'any']) }}
      </div>
    </div>
    <div class="form-group row">
      {{ Form::label('porc_min', 'Porc Minorista', ['class' => 'col-sm-2 col-form-label text-sm-right']) }}
      <div class="col-sm-10">
          {{ Form::number('porc_min', null, ['class' => 'form-control text-right', 'step' => 'any']) }}
      </div>
    </div>
    <div class="form-group row">
      {{ Form::label('cant_may', 'Cantidad Mayorista', ['class' => 'col-sm-2 col-form-label text-sm-right']) }}
      <div class="col-sm-10">
          {{ Form::number('cant_may', null, ['class' => 'form-control text-right', 'step' => 'any']) }}
      </div>
    </div>
    <div class="form-group row">
      {{ Form::label('porc_may', 'Porc Mayorista', ['class' => 'col-sm-2 col-form-label text-sm-right']) }}
      <div class="col-sm-10">
          {{ Form::number('porc_may', null, ['class' => 'form-control text-right', 'step' => 'any']) }}
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-10 offset-sm-2">
          {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
      </div>
    </div>
  </div>
  <div class="col-md-4">
    @if($saleproduct->barcode != null)
      <div class="row">
        <div class="col-12 d-flex justify-content-center">

          {!! DNS1D::getBarcodeHTML($saleproduct->barcode, 'C128') !!}
        </div>

      </div>
      <div class="row">
        <div class="col-12 d-flex justify-content-center">
          <h5>{{ $saleproduct->barcode }}</h5>
        </div>

      </div>
    @else
    <div class="row">
      <div class="col-12 d-flex justify-content-center">

        {!! DNS1D::getBarcodeHTML('000000000000', 'C128') !!}
      </div>

    </div>
    <div class="row">
      <div class="col-12 d-flex justify-content-center">
        <h5>0000000000000</h5>
      </div>

    </div>
    @endif

      <div class="row">
        <div class="col-12 d-flex justify-content-center">
          <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#leerBarcodeModal" name="button">LEER</button>
          <button type="button" class="btn btn-sm btn-primary ml-2" name="button">GENERAR</button>
        </div>
      </div>

  </div>
</div>

<!-- Modal Leer BARCODE -->
<div class="modal fade" id="leerBarcodeModal" tabindex="-1" role="dialog" aria-labelledby="leerBarcodeModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-body">

          <div class="form-group">
            <label for="cantidad">Pase el Scanner por el código</label>
            <input type="text" class="form-control text-right"  name="barcode" id="barcode"  >
          </div>


      </div>

    </div>
  </div>
</div>


@push('scripts')
<script src="/{{ env('URL_REMOTE', '') }}vendor/select2/dist/js/select2.min.js"></script>
<script src="/{{ env('URL_REMOTE', '') }}vendor/stringToSlug/jquery.stringToSlug.min.js"></script>
<script>
  $(document).ready(function(){
    $('#name, #slug').stringToSlug({
      callback:function(text){
        $('#slug').val(text);
      }
    });

    $("select").select2({

    });
  });

  $('#leerBarcodeModal').on('shown.bs.modal', function (e) {
    $('#barcode').focus();
    $('#barcode').select();



  });
</script>


@endpush
