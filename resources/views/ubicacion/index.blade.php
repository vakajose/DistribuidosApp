@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/reclamoMap.css') }}">
@stop
@section('content')
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7rA_S45QDgDMDZxSig5pFSbWEbLGxlsk&callback=initMap" async defer></script>
<script src="{{ asset('js/reclamoMap.js') }}"></script>
@stop