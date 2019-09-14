
<div class="form-group row">
  {{ Form::label('name', 'Nombre del Producto Stock', ['class' => 'col-sm-2 col-form-label text-sm-right']) }}
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
  {{ Form::label('category_id', 'Categorías', ['class' => 'col-sm-2 col-form-label text-sm-right']) }}
  <div class="col-sm-10 d-flex align-items-center">
      {{ Form::select('category_id', $categories, null, ['class' => 'form-control', 'id' => 'select']) }}
  </div>
</div>
<div class="form-group row">
  {{ Form::label('stockproductgroup_id', 'Grupo', ['class' => 'col-sm-2 col-form-label text-sm-right']) }}
  <div class="col-sm-10 d-flex align-items-center">
      {{ Form::select('stockproductgroup_id', $stockproductgroups, null, ['class' => 'form-control', 'id' => 'select2', 'placeholder' => '** Seleccionar un grupo']) }}
  </div>
</div>
<div class="form-group row">
  {{ Form::label('stock', 'Stock', ['class' => 'col-sm-2 col-form-label text-sm-right']) }}
  <div class="col-sm-10">
      {{ Form::number('stock', null, ['class' => 'form-control text-right', 'step' => 'any']) }}
  </div>
</div>
<div class="form-group row">
  {{ Form::label('stock_deposito', 'Stock Depósito', ['class' => 'col-sm-2 col-form-label text-sm-right']) }}
  <div class="col-sm-10">
      {{ Form::number('stock_deposito', null, ['class' => 'form-control text-right', 'step' => 'any']) }}
  </div>
</div>
<div class="form-group row">
  {{ Form::label('costo', 'Costo', ['class' => 'col-sm-2 col-form-label text-sm-right']) }}
  <div class="col-sm-10">
      {{ Form::number('costo', null, ['class' => 'form-control text-right', 'step' => 'any']) }}
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


    $("select2").select2({

    });
  });
</script>
@endpush
