{!! Form::open(['route' => ['clients.show', $client->id], 'method' => 'GET']) !!}
<div class="row">
  <div class="col-md-7 offset-md-5 col-lg-5 offset-lg-7">

    <div class="form-group">
      <div class="input-group">
        <input type="text" name="daterange" class="form-control float-right" id="daterange" value="{{ $daterange }}" autocomplete="off">
        <div class="input-group-append">
          <span class="input-group-text">
            <i class="far fa-calendar-alt"></i>
          </span>
        </div>
        <div class="input-group-append">
          <button class="btn btn-secondary" type="submit" id="button-addon2">Buscar</button>
        </div>

      </div>
    </div>



  </div>

</div>

{{ Form::close() }}


@push('scripts')
<!-- Select2 -->
<script src="/{{ env('URL_REMOTE', '') }}plugins/select2/js/select2.full.min.js"></script>

<!-- InputMask -->
<script src="/{{ env('URL_REMOTE', '') }}plugins/inputmask/jquery.inputmask.bundle.js"></script>
<script src="/{{ env('URL_REMOTE', '') }}plugins/moment/moment.min.js"></script>

<!-- date-range-picker -->
<script src="/{{ env('URL_REMOTE', '') }}plugins/daterangepicker/daterangepicker.js"></script>



<script type="text/javascript">

  $(document).ready(function(){
    //Date range picker
    $('#daterange').daterangepicker({
      autoUpdateInput: false,
      locale: {
        format: 'DD/MM/YYYY',
        applyLabel: 'Aplicar',
        cancelLabel: 'Limpiar',
        fromLabel: 'Desde',
        toLabel: 'Hasta',
        customRangeLabel: 'Seleccionar rango',
        daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre',
            'Diciembre'],
        firstDay: 1,
        maxDate: 0
      }
    },
      function(start_date, end_date) {
        $('#daterange').val(start_date.format('DD/MM/YYYY')+' - '+end_date.format('DD/MM/YYYY'));
      });


  })

</script>
@endpush
