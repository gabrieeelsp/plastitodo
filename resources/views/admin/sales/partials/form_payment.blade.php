
{{ Form::hidden('sale_id', $sale->id) }}

<div class="col-sm-1 d-flex align-items-center justify-content-end">
  {{ Form::label('paymentmethod_id', 'Tipo', ['class' => '']) }}
</div>
<div class="col-sm-4 d-flex align-items-center">
  {{ Form::select('paymentmethod_id', $paymentmethods, null, ['class' => 'form-control', 'id' => 'select']) }}
</div>
<div class="col-sm-2 d-flex align-items-center justify-content-end">
  {{ Form::label('valor', 'Monto', ['class' => 'text-right']) }}
</div>
<div class="col-sm-3 d-flex align-items-center">
  {{ Form::number('valor', null, ['class' => 'form-control', 'step' => 'any']) }}
</div>
<div class="col-sm-2 d-flex align-items-center">
  <button type="submit" class="btn btn-sm btn-primary">Submit</button>
</div>




@push('scripts')
<script src="/{{ env('URL_REMOTE', '') }}vendor/select2/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function(){

    $("select").select2({

    });
  });
</script>
@endpush
