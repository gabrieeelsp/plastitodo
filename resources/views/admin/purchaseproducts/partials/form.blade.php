
@if(!isset($purchaseproduct))
<div class="form-group row">
  {{ Form::label('stockproduct_id', 'Producto Stock', ['class' => 'col-sm-2 col-form-label text-sm-right']) }}
  <div class="col-sm-10 d-flex align-items-center">
      {{ Form::select('stockproduct_id', $stockproducts, null, ['class' => 'form-control', 'id' => 'select2', 'placeholder' => '** Seleccionar un Producto Stock']) }}
  </div>
</div>
@else
<div class="form-group row">
  {{ Form::label('stockproduct_name', 'Producto Stock', ['class' => 'col-sm-2 col-form-label text-sm-right']) }}
  <div class="col-sm-10">
      <input type="text" name="stockproduct_name" value="{{ $purchaseproduct->stockproduct->name }}" class="form-control" disabled>
  </div>
</div>
@endif
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
  {{ Form::label('rel_stock_compra', 'Relacion Stock Compra', ['class' => 'col-sm-2 col-form-label text-sm-right']) }}
  <div class="col-sm-10">
      {{ Form::number('rel_stock_compra', null, ['class' => 'form-control text-right', 'step' => 'any']) }}
  </div>
</div>

<div class="form-group row">
  <div class="col-sm-10 offset-sm-2">
      {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
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
</script>
@endpush
