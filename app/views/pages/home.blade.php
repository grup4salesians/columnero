@extends('layouts.master')
@section('title')
Home
@stop
@section('content')
	<div id="contingut_home">
		<div class="row">
			<?php $nom = Auth::user()->getFullNameAttribute(); ?>
			@include('includes/columna')
			@include('includes/columna')
			@include('includes/columna')
		</div>
	</div>
@stop
