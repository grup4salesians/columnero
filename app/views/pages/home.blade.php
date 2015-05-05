@extends('layouts.master')
@section('title')
Home
@stop
@section('content')
	<div id="contingut_home">
		<div class="row row-horizon">
			<?php $nom = Auth::user()->getFullNameAttribute(); ?>
			@include('includes/columna')
			@include('includes/columna')
			@include('includes/columna')
			@include('includes/columna')
		</div>
	</div>

	<script>
		$(function() {
			$('#contingut_home').height($(window).height() - $('.header').height() - $('.footer').height());
			$(window).on('resize', function() {
				$('#contingut_home').height($(window).height() - $('.header').height() - $('.footer').height());
			});
		});
	</script>
@stop
