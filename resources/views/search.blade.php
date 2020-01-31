<!DOCTYPE html>

<html>

<head>

<meta name="_token" content="{{ csrf_token() }}">



<title>Live Searssch</title>

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

</head>

<body>


  {!! Form::open(['route' => 'WebserviceController.enviarPeticionAdd', 'method' => 'GET']) !!}
  <div class="form-group row">
    {{ Form::label('name', 'Nombre', ['class' => 'col-sm-2 col-form-label text-sm-right']) }}
    <div class="col-sm-10">
        {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
    </div>
  </div>

  <div class="form-group row">
    {{ Form::label('slug', 'URL', ['class' => 'col-sm-2 col-form-label text-sm-right']) }}
    <div class="col-sm-10">
        {{ Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug']) }}
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-10 offset-sm-2">
        {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
    </div>
  </div>
  {!! Form::close() !!}
</body>

</html>
