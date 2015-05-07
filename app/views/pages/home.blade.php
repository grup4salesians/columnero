@extends('layouts.master')
@section('title')
Home
@stop
@section('content')
<div id="contingut_home">
    <div class="row row-horizon">

        <div id='busqueda_home' style="display: none;">
            <div id='ordenar_home'>
                <i id="show-ordenar_home" class="fa fa-times"></i>
                {{ Form::open(array('url' => '/cercarhome')) }}
                <fieldset>
                    <legend>Ordenar per</legend>
                    <span class='titulsbusqueda'>Millor valorats</span> <input id="millorvalorats" name="millorvalorats" type="checkbox">
                    <span class='titulsbusqueda'>Tots</span> <input  name="radio1" value="tots" checked="checked" id="filtrocheckbox" type="radio">
                    <span class='titulsbusqueda'>Setmana</span> <input name="radio1" value="setmana" id="filtrocheckbox" type="radio">
                    <span class='titulsbusqueda'>Mes</span> <input name="radio1" value="mes" id="filtrocheckbox"  type="radio">
                    <input type="submit" class="btn btn-default" value="Enviar">
                </fieldset>
                {{ Form::close() }}
            </div>
        </div>
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

            <div id="capnota_home">
                <div class="row margin">
                    <div class="col-md-12">
                        <h4 class="page-head-line">No tens cap nota? Crea una nova!</h4>
                    </div>
                </div>
                <a href="<?php Config::get('constants.BaseUrl'); ?>../public/novanota"<input type="submit" class="btn btn-warning" style="margin:auto;padding:10px;font-size:25px;margin-bottom:10px;">Crear una nova nota</a>
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
        $(document).on('click', '#show-ordenar_home', function () {
            $('#busqueda_home').stop().slideToggle();
        });
    });

</script>
@stop

