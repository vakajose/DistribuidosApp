@extends('adminlte::page')

@section('title', 'Estadisticas')

@section('content_header')
    <h1>Estadisticas por encuesta</h1>
@stop

@section('content')

<div class="row">
	<div class="container">
		<div class="box box-info" >
			<div class="box-header with-border">
				<h3 class="box-title">Encuesta: </h3>
				<select class="" onchange="changeEstadistica()">
							@foreach ($encuestas as $enc)
								<option value="{{$enc->id}}">{{$enc->titulo}}</option>
							@endforeach
				</select>
				{{-- <form class="inline" action="{{ route('estadisticasPorEncuesta') }}" method="POST">
					<div class="form-group">
						<select class="form-control" name="encuesta">
							@foreach ($encuestas as $enc)
								<option value="{{$enc->id}}">{{$enc->titulo}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<button class="form-control" type="submit"></button>
					</div>
				</form> --}}
			</div>
		</div>

		
		<div class="box box-success">
			<div class="box-header with-border">
				
			</div>
		</div>
	</div>
</div>

@stop

@section('js')
{{-- <script src="{{ asset('js/estadisticas.js') }}"></script>
<script>
	var pieData = @json($pieData);
</script> --}}
@stop