@extends('adminlte::page')

@section('title', 'Estadisticas')

@section('content_header')
    <h1>Estadisticas de encuentas</h1>
@stop

@section('content')



	<div class="box box-info box-solid" >
		<div class="box-header with-border">
			<h3 class="box-title">Total de encuestas respondidas</h3>
		</div>
		<div class="box-body">
			<canvas id="pieChart" height="100%" "></canvas>
		</div>
	</div>
	

@stop

@section('js')
<script src="{{ asset('js/estadisticas.js') }}"></script>
<script>
	var pieData = @json($pieData);
</script>
@stop