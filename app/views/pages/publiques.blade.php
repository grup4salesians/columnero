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
                    <input name="cercarpubliques" placeholder='tag1,tag2,tag3..' id="e"  type="text">
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

            $query = DB::table('posts')
                    ->join('usuaris', 'posts.usuari_id', '=', 'usuaris.id')
                    ->where('privat', 1)
                    ->select('posts.id', 'posts.titol','posts.comentari','usuaris.nick', 'posts.data')
                    ->take(10)
                    ->get();

            for ($i = 0; $i < count($query); $i++) {
                $titolNota = $query[$i]->titol;
                $comentariNota = $query[$i]->comentari;
                $nick = $query[$i]->nick;

                $queryCategories = DB::table('posts')   //Select que coge todos los tags de esa nota, porque una nota puede estar compuesta por mas de un tag
                        ->join('postscategories', 'posts.id', '=', 'postscategories.post_id')
                        ->join('categories', 'postscategories.categoria_id', '=', 'categories.id')
                        ->where('posts.id', $query[$i]->id)
                        ->select('categories.nom')
                        ->get();
                $categories = "";
                for ($j = 0; $j < count($queryCategories); $j++) {
                    $categories = $categories . ", " . $queryCategories[$j]->nom;
                }
                $categories = substr($categories, 2);
                ?>   

                @include('includes/nota')
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

