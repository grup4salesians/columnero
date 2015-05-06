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
        #contingut_home{
            height:auto;
        }
        #busqueda_home{
            width:100%;
            height:160px;
        }
    }
    #show-ordenar_home {
        height: 28px;
        text-align: center;
        background-color: lime;
        width: 28px;
        border-radius: 14px;
        position: fixed;
        z-index: 1;
        right: 19px;
        top: 63px;

    }
    #show-ordenar_home:hover {
        background-color: limegreen;
        cursor: pointer;
    }
</style>
<div id="contingut_home">
    <div class="row row-horizon">
        <div id="show-ordenar_home">
            ^
        </div>
        <div id='busqueda_home'>
            <div id='ordenar_home'>
                {{ Form::open(array('url' => '/publiques')) }}
                <fieldset>
                    <legend>Ordenar per</legend>
                    <span class='titulsbusqueda'>Millor valorats</span> <input id="millorvalorats" name="millorvalorats" type="checkbox">
                    <span class='titulsbusqueda'>Tots</span> <input  name="radio1" value="tots" checked="checked" id="filtrocheckbox" type="radio">
                    <span class='titulsbusqueda'>Setmana</span> <input name="radio1" value="setmana" id="filtrocheckbox" type="radio">
                    <span class='titulsbusqueda'>Mes</span> <input name="radio1" value="mes" id="filtrocheckbox"  type="radio">
                    <input name="cercarpubliques" placeholder='tag1,tag2,tag3..' id=""  type="text">
                    <input type="submit" class="btn btn-default" value="Enviar">
                </fieldset>
                {{ Form::close() }}
            </div>
        </div>

        <?php
        //Filtres son:
        // $filtrodata['cercarpubliques'];
        //$filtrodata['millorvalorats'];
        //$filtrodata['radio1'];
        if (!(empty($filtrodata))) {
            
        } else {
            //PONER QUERY DE ULTIMOS 10 POST.

            $query = DB::table('usuaris')
                    ->join('posts', 'usuaris.id', '=', 'posts.usuari_id')
                    ->join('postscategories', 'posts.id', '=', 'postscategories.post_id')
                    ->join('categories', 'postscategories.categoria_id', '=', 'categories.id')
                    // ->whereBetween('posts.data',array('2015-05-05 00:00:00','2015-05-05 00:00:00'))    
                    //->whereIn('categories.nom',$varia)    
                    ->select('postscategories.post_id', 'posts.titol', 'posts.comentari', 'posts.data', 'postscategories.categoria_id', 'categories.nom')
                    ->take(10)
                    ->get();
            for ($j = 0; $j < count($query); $j++) {
                $categoria = $query[$j]->nom;
                ?>
                @include('includes/columna')
                <?php
            }
        }
        ?>
    </div>
</div>
<script>
    $(function () {
        $('#contingut_home').height($(window).height() - $('.header').height() - $('.footer').height());
        $(window).on('resize', function () {
            $('#contingut_home').height($(window).height() - $('.header').height() - $('.footer').height());
        });
        $('#show-ordenar_home').on('click', function () {
            $('#busqueda_home').stop().slideToggle();
        });
    });
</script>
@stop

