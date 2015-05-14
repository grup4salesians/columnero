@extends('layouts.home-master')
@section('title')
Home
@stop
@section('head')
@parent
    {{ HTML::style('css/home.css'); }}
@stop
@section('content')
<div id="contingut_home">
    <i id="show-columns" class="fa fa-plus fa-c1" data-toggle="modal" data-target="#myModal"></i>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Administrar Columnas</h4>
          </div>
          <div class="modal-body">
            <?php 
                $queryCategories = DB::table('categories')  
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

                    echo Form::checkbox('cbx-'.$idCategoria, $idCategoria);
                    echo Form::label('cbx-'.$idCategoria, $categoria);
                    echo '<br />';
                }
            ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <div id="sortable" class="row row-horizon">
        <?php
        $nom = Auth::user()->getFullNameAttribute();
        $queryCategories = DB::table('categories')
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
                    <i class="fa fa-edit dashboard-div-icon" style="font-size: 34px;"></i>
                    <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                        </div>
                    </div>
                    <h5><a class="linkAlert" style="color:white" href="<?php Config::get('constants.BaseUrl'); ?>../public/novanota">Crear una nova nota</a></h5>
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
            //console.log(search);
            $(search).stop().slideToggle();
        })
        .on('click', "#busqueda_home button", function sortTitle(e){
        	e.preventDefault();
        	var $button = $(this),
        		action = $(this).attr('id');
			switch(action) {
				case 'ordenarTitulo':
					ordenar($button, '.panel-title');
					break;
				case 'ordenarFecha':
					ordenar($button, '.panel-title', 'date');
					break;
			}
        });

        var $columnas = $('div[id^=column-]');
        $columnas.each(function(index) {
            //console.log($(this).find('input[class^=search-]').attr('class'));
            //console.log($(this).attr('id'));
            var options = {
              valueNames: [ 'panel-title', 'panel-body', 'autor', 'categories'],
              searchClass: $(this).find('input[class^=search-]').attr('class'),
              indexAsync: true
            };

            var userList = new List($(this).attr('id'), options);
            
            $(this).data('position', index);

        });

        $( "#sortable" ).sortable({
            update: function() {
                var $columnas = $('div[id^=column-]'),
                    categories = '',
                    positions = '',
                    url = '';

                $columnas.each(function(index) {
                    if (index === 0) {
                        categories = $(this).data('categoria-id');
                        //positions = $(this).data('position');
                    } else {
                        categories += '|' + $(this).data('categoria-id');
                        //positions += '|' + $(this).data('position');
                    }
                });
                url = 'categories/setpositions/' + categories;

                $.ajax({
                    url: url
                    //context: document.body
                }).done(function() {
                    //$( this ).addClass( "done" );
                    console.log(url);
                });

            }
        });

    });

	
	function ordenar($button, aOrdenar, data) {
		var idColumn = $button.closest('#busqueda_home').data('column-id');
        	var filtre = '.panel.columna.panel-primary[data-column-id="' + idColumn + '"] .panel.panel-default';
        	var order = '';
        	if ($button.hasClass('desc')) {
        		order = 'desc';
        		$button.removeClass('desc');
        	} else {
        		order = 'asc';
        		$button.addClass('desc');
        	}
        	if (typeof data !== 'undefined')
        		tinysort(filtre, {data: data, order: order});
        	else
        		tinysort(filtre, {selector: aOrdenar, order: order});
	}

</script>
@stop

