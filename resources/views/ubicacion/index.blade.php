@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Ubicaciones de Encuestadores</h1>
@stop
@section('css')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/reclamoMap.css') }}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
@stop
@section('content')
@php
	$users = App\User::all();
@endphp
<div class="container col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-12">

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Usuarios</h3>
			<div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                
              </div>
		</div>
		<div class="box-body">
		<table class="table table-condensed table-hover" id="reclamos_table">
		<thead>
			<tr>			
				<th>ID</th>				
				<th>email</th>
				<th>Estado</th>
			</tr>
		</thead>
		<tbody>
			@if (empty($users))
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			@endif
			@foreach ($users as $user)
				<tr id="usr-"{{ $user->id }}>
					<td>{{ $user->id }}</td>
					<td>{{ $user->email }}</td>
					<td align="center">		
							<i  id="estado-{{ $user->id }}" class="fas fa-circle {{ $user->estado }}"></i>
					</td>
				</tr>
			@endforeach
			
		</tbody>
		</table>
		</div>
	</div>

	</div>
    <div class="container col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 fill">
	
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title">Mapa</h3>
			
		</div>
		<div class="box-body">				
				<div class="container-fluid" id="map"></div>
		</div>
	</div>
</div>
@stop
@section('js')
<script>
	var users = @json($users);
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7rA_S45QDgDMDZxSig5pFSbWEbLGxlsk&callback=initMap" async defer></script>
<script src="{{ asset('js/reclamoMap.js') }}"></script>
@stop