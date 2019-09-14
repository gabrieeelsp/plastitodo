{!! Form::open(['route' => ['proveedors.index'], 'method' => 'GET']) !!}
<div class="row">
  <div class="col-md-6 offset-md-6 col-lg-4 offset-lg-8">
    <div class="input-group mb-3">
      <input type="text"  name="searchText" id="searchinput" class="form-control" value="{{ $searchText }}" placeholder="Buscar..." aria-label="Recipient's username" aria-describedby="button-addon2">
      <div class="input-group-append">
        <button class="btn btn-secondary" type="submit" id="button-addon2">Buscar</button>
      </div>
    </div>
  </div>
</div>

{{ Form::close() }}


@push('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    $('#searchinput').focus();
    $('#searchinput').select();
  })

</script>
@endpush
