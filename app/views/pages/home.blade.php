@extends('layouts.master')
@section('title')
Home
@stop
@section('content')
<style>

</style>
<div id="contingut_home">
    <div class="row row-horizon">

        <?php
        $nom = Auth::user()->getFullNameAttribute();
        $queryCategories = DB::table('categories')   //Select que coge todos los tags de esa nota, porque una nota puede estar compuesta por mas de un tag
                ->join('categoriesusuaris', 'categories.id', '=', 'categoriesusuaris.categories_id')
                ->join('usuaris', 'categoriesusuaris.usuaris_id', '=', 'usuaris.id')
                ->where('usuaris.id', Auth::user()->id)
                ->whereNotNull('categoriesusuaris.mostrar')
                ->orderBy('categoriesusuaris.mostrar')
                ->select('categories.nom', 'categoriesusuaris.categories_id')
                ->get();

        for ($j = 0; $j < count($queryCategories); $j++) {
            $categoria = $queryCategories[$j]->nom;
            $idCategoria = $queryCategories[$j]->categories_id;
            ?>
            @include('includes/columna')
            <?php
        }
        if ($j == 0) {
            ?>

<!--            <div id="capnota_home">
                <div class="row margin">
                    <div class="col-md-12">
                        <h4 class="page-head-line">No tens cap nota? Crea una nova!</h4>
                    </div>
                </div>
                <a href="<?php Config::get('constants.BaseUrl'); ?>../public/novanota"<input type="submit" class="btn btn-warning" style="margin:auto;padding:10px;font-size:25px;margin-bottom:10px;">Crear una nova nota</a>
            </div>-->
            <div class="col-md-4 col-sm-2 col-xs-0">

            </div>
            <div class="col-md-4 col-sm-8 col-xs-12" style="padding-top: 16%;">
                 <div class="dashboard-div-wrapper bk-clr-two">
                    <i class="fa fa-edit dashboard-div-icon"></i>
                    <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                        </div>
                    </div>
                    <h5><a class="linkAlert" href="<?php Config::get('constants.BaseUrl'); ?>../public/novanota">Crear una nova nota</a></h5>
                </div>
            </div>
            <div class="col-md-4 col-sm-2 col-xs-0">

            </div>
           
        <?php } ?>


    </div>
</div>
<script>
    $(function () {
        $('#contingut_home').height($(window).height() - $('.header').height() - $('.footer').height());
        $(window).on('resize', function () {
            $('#contingut_home').height($(window).height() - $('.header').height() - $('.footer').height());
        });
        $(document).on('click', '.show-ordenar_home', function () {
        	var idColumn = $(this).data('column-id');
        	var search = '#busqueda_home[data-column-id="' + idColumn + '"]';
        	console.log(search);
            $(search).stop().slideToggle();
        });

        $(document).on('click', "#ordenarTitulo", function sortTitle(e){
        	e.preventDefault();
        	var idColumn = $(this).closest('#busqueda_home').data('column-id');
        	var filtre = '.panel.columna.panel-primary[data-column-id="' + idColumn + '"] .panel.panel-default';
        	var order = '';
        	if ($(this).hasClass('desc')) {
        		order = 'desc';
        		$(this).removeClass('desc');
        	} else {
        		order = 'asc';
        		$(this).addClass('desc');
        	}
        	tinysort(filtre, {selector: '.panel-title', order: order});
        });
    });

</script>
@stop

