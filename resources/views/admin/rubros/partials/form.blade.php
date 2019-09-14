<div class="form-group row">
  {{ Form::label('name', 'Nombre del Rubro', ['class' => 'col-sm-2 col-form-label text-sm-right']) }}
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
  <div class="col-sm-10 offset-sm-2">
      {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
  </div>
</div>


@push('scripts')
<script src="/{{ env('URL_REMOTE', '') }}vendor/stringToSlug/jquery.stringToSlug.min.js"></script>
<script>
  $(document).ready(function(){
    $('#name, #slug').stringToSlug({
      callback:function(text){
        $('#slug').val(text);
      }
    });
  })
</script>
@endpush
