@extends('adminlte::page')

@section('title', 'Estadisticas')

@section('content_header')
    <h1>Estadisticas de encuentas</h1>
@stop

@section('content')

<div class="row">
	<div class="container">
		<div class="box box-info" >
			<div class="box-header with-border">
				<h3 class="box-title">Total de encuestas respondidas</h3>
			</div>
			<div class="box-body">
				<canvas id="pieChart" height="260px" "></canvas>
			</div>
		</div>
	</div>
</div>

@stop