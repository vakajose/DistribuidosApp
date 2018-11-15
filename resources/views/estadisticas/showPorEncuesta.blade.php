@extends('adminlte::page')

@section('title', 'Estadisticas')

@section('content_header')
    <h1>Estadisticas por encuesta</h1>
    	<form action="{{ route('estadisticasPorEncuesta.change') }}" method="POST" role="form" class="form-inline">
				{{csrf_field()}}
					
				<div class="form-group">
					<label class="sr-only" for="encuesta">Encuesta</label>
					<select name="encuesta" id="encuesta" name="encuesta" class="form-control" required="required">
							<option value="0">--SELECCIONE UNA ENCUESTA--</option>
						@foreach ($encuestas as $enc)
							<option value="{{$enc->id}}">{{$enc->titulo}}</option>
						@endforeach
					</select>
				</div>
				<button type="submit" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i></button>
				</form>
@stop

@section('content')
	{{-- solo se imprimen si existen  --}}
	@isset ($encuesta)
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box box-info box-solid" >
		<div class="box-header with-border">
			<h3 class="box-title">
				@isset ($encuesta)
					<b> {{$encuesta->titulo}}</b>    
				@endisset
			</h3>
			
			
		</div>
	</div>
	</div>	
	    @foreach ($encuesta->preguntas as $pregunta)
	
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title">{{$pregunta->texto}}</h3>
					<button type="button" class="btn btn-box-tool pull-right" data-widget="collapse"><i class="fa fa-minus"></i>
        		</button>
				</div>
				<div class="box-body">
						<canvas id="chart-{{$pregunta->id}}" height="70px"></canvas>
				</div>
			</div>
		</div>
	@endforeach	
	@endisset
@stop
@section('js')
 @isset ($labels)
    <script>
    	var preguntas = @json($encuesta->preguntas);
		var labels = @json($labels);
		var datas = @json($datas);
		console.log(labels);
		console.log(datas);
	</script>
	<script src="{{ asset('js/porEncuesta.js') }}"></script> 
 @endisset
@stop
