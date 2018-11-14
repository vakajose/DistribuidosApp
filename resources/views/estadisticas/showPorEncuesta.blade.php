@extends('adminlte::page')

@section('title', 'Estadisticas')

@section('content_header')
    <h1>Estadisticas por encuesta</h1>
@stop

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col col-md-offset-1 col-lg-offset-1">
		<div class="box box-info" >
			<div class="box-header with-border">
				<h3 class="box-title">Encuesta:<b> {{$encuesta->titulo}}</b></h3>
				<div class="box-tools pull-right">
					<form action="{{ route('estadisticasPorEncuesta.change') }}" method="POST" role="form" class="form-inline">
					{{csrf_field()}}
					<div class="form-group">
						<select name="encuesta" id="encuesta" name="encuesta" class="form-control form-control-sm" required="required">
							@foreach ($encuestas as $enc)
								<option value="{{$enc->id}}">{{$enc->titulo}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i></button>	
					</div>
				</form>

				</div>
				

			</div>
		</div>
		</div>	
	</div>
	
		@foreach ($encuesta->preguntas as $pregunta)
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col col-md-offset-1 col-lg-offset-1">
				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">{{$pregunta->texto}}</h3>
						<button type="button" class="btn btn-box-tool pull-right" data-widget="collapse"><i class="fa fa-minus"></i>
            		</button>
					</div>
					<div class="box-body">
						<div class="row">
							<canvas id="chart-{{$pregunta->id}}" height="260px" "></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach	
@stop

@section('js')
<script>
	var preguntas = @json($encuesta->preguntas);	
	console.log(preguntas);

	
		var labels = @json($labels);
		var datas = @json($datas);
		console.log(labels);
		console.log(datas);
	
</script>
<script src="{{ asset('js/porEncuesta.js') }}"></script>
@stop