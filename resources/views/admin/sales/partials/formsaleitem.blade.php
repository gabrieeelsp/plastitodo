{{ Form::hidden('sale_id', $sale->id) }}




  {{ Form::hidden('cantidad', null, ['class' => 'form-control text-right', 'step' => 'any', 'min' => '1']) }}



@push('scripts')

@endpush
