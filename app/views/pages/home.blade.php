@extends('layouts.master')
@section('title')
Home
@stop
@section('content')
	<style>
	    .titulsbusqueda{
	        margin-left:10px;
	        font-weight:bold;
	    }
	    .btnfiltrar{
	        float:right;
	        padding-right:5px;
	        padding-left:5px;
	        background-color: blue;
	        margin-right:5px;
	    }
	    @media screen and (max-width: 770px) {
	    #ordenar_home{
	        width:90%;
	       height:130px;
	    }
	    #busqueda_home{
	        width:100%;
	        height:160px;
	    }
	}
	</style>
	<div id="contingut_home">
	    <div id='busqueda_home'>
	        <div id='ordenar_home'>
	             {{ Form::open(array('url' => '/cercarhome')) }}
	                <fieldset>
	                    <legend style='margin-left:5px;'>Ordenar per</legend>
	                    <span class='titulsbusqueda'>Millor valorats</span> <input  type="checkbox">
	                    <span class='titulsbusqueda'>Tots</span> <input  name="radio1" checked="checked" id="filtrocheckbox" type="radio">
	                    <span class='titulsbusqueda'>Setmana</span> <input name="radio1" id="filtrocheckbox" type="radio">
	                    <span class='titulsbusqueda'>Mes</span> <input name="radio1" id="filtrocheckbox"  type="radio">
	                    <input  style="margin-left:20px;" placeholder="tag1,tag2.." type="text">
	                    <input type="submit" class="btn btn-default" value="Enviar">
	                </fieldset>
	           {{ Form::close() }}
	        </div>
	    </div>
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
