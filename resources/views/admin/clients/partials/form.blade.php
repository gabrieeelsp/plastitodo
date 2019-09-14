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
  {{ Form::label('tipo', 'Tipo', ['class' => 'col-sm-2 col-form-label text-sm-right']) }}
  <div class="col-sm-10 d-flex align-items-center">
      {{ Form::select('tipo', ['Minorista' => 'Minorista', 'Mayorista' => 'Mayorista'], null, ['class' => 'form-control', 'id' => 'select']) }}
  </div>
</div>

<div class="form-group row">
  {{ Form::label('direccion', 'Dirección', ['class' => 'col-sm-2 col-form-label text-sm-right']) }}
  <div class="col-sm-10">
      {{ Form::text('direccion', null, ['class' => 'form-control']) }}
  </div>
</div>
<div class="form-group row">
  {{ Form::label('telefono', 'Telefono', ['class' => 'col-sm-2 col-form-label text-sm-right']) }}
  <div class="col-sm-10">
      {{ Form::text('telefono', null, ['class' => 'form-control']) }}
  </div>
</div>

<div class="form-group row">
  {{ Form::label('comentario', 'Comentarios', ['class' => 'col-sm-2 col-form-label text-sm-right']) }}
  <div class="col-sm-10">
      {{ Form::textarea('comentario', null, ['class' => 'form-control', 'id' => 'comentario']) }}
  </div>
</div>

<div class="form-group row">
  <div class="col-sm-10 offset-sm-2">
      {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
  </div>
</div>


@push('scripts')
<script src="/{{ env('URL_REMOTE', '') }}vendor/stringToSlug/jquery.stringToSlug.min.js"></script>
<script src="/{{ env('URL_REMOTE', '') }}vendor/ckeditor/ckeditor.js"></script>
<script>
  $(document).ready(function(){
    $('#name, #slug').stringToSlug({
      callback:function(text){
        $('#slug').val(text);
      }
    });
    CKEDITOR.replace('comentario');
  });
</script>
@endpush
