@extends('layouts.master')
@section('title')
Les meves notes
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
    .dashboard-div-wrapper {
        border-radius: 5px;
        text-align: center;
        padding: 15px;
        color: #fff;
        margin-bottom: 50px;
    }
    .dashboard-div-icon {
        height: 75px;
        width: 75px;
        border: 2px solid #fff;
        padding: 20px;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        font-size: 30px;
        margin-bottom: 20px;
        color: #fff;
    }
    .linkAlert:hover {
        text-decoration: none;
        color: white;
        cursor: pointer;
        border-bottom: 2px solid white;
    }
    .linkAlert {
        color: white;
        font-weight: bold;
        font-size: 18px;
    }
    .bk-clr-two {
        background-color: rgba(249, 76, 76, 0.86);
    }
</style>
<div id="contingut_home">
    <div class="row row-horizon">
        <div id="show-ordenar_home">
            ^
        </div>
        <div id='busqueda_home' style="display:none;">
            <div id='ordenar_home'>
                {{ Form::open(array('url' => '/mevesnotes')) }}
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
                    ->where('usuaris.id','=',Auth::user()->id)
                    ->select('posts.id', 'posts.titol','posts.comentari','usuaris.nick', 'posts.data')
                    ->get();

            if(count($query) ==0 ){ ?>
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
            <?php }else{
               for ($i = 0; $i < count($query); $i++) {
                $titolNota = $query[$i]->titol;
                $comentariNota = $query[$i]->comentari;
                $nick = $query[$i]->nick;
                $idnota = $query[$i]->id;

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
                <div class="col-xs-12 col-sm-5 col-md-4" style="float:left; display:block;">
                    @include('includes/notapersonal')
                </div>
                <?php
            } 
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

