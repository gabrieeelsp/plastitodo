{{ Form::hidden('sale_id', $sale->id) }}
<div class="form-group">
  <input id="saleproduct_barcode" type="text" class="form-control" >
</div>



  {{ Form::hidden('cantidad', null, ['class' => 'form-control text-right', 'step' => 'any', 'min' => '1']) }}

<div class="form-group">
  <button type="button" class="btn btn-sm btn-success ml-2" data-toggle="modal" data-target="#selectSaleProductModal">
  +
</button>

</div>

@push('scripts')

@endpush
