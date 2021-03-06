@extends('layouts.master')
@section('title')
Les meves notes
@stop
@section('content')
<style>
    * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
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
    #ordenar_home{
        width: 300px;
        height:120px;
    }
</style>
<script>
    $(document).ready(function() {
        $('.cl-menu-mevesnotes').css('background-color', '#F0677C');
    });
</script>
<script src="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/packery/dist/packery.pkgd.min.js" type="text/javascript"></script>

<div id="contingut_home">
    <div>

        <div id='busqueda_home'>
            <div id='ordenar_home'>
                {{ Form::open(array('url' => '/mevesnotes')) }}
                <fieldset>
                    <legend>Buscar per</legend>
                    <input name="cercarpubliques" placeholder='tag1,tag2,tag3..' id="cercarpubliques"  type="text">
                    <input type="submit" class="btn btn-default" value="Enviar">
                </fieldset>
                {{ Form::close() }}
            </div>
        </div>

        <?php
        if (!(empty($tags))) {
            $queryfiltro = DB::table('posts')
                    ->join('usuaris', 'posts.usuari_id', '=', 'usuaris.id')
                    ->join('postscategories', 'posts.id', '=', 'postscategories.post_id')
                    ->join('categories', 'postscategories.categoria_id', '=', 'categories.id')
                    ->where('posts.privat', 0)
                    ->where('usuaris.id', '=', Auth::user()->id)
                    ->whereIn('categories.nom', $tags)
                    ->select('posts.id', 'posts.titol', 'posts.comentari', 'usuaris.nick', 'posts.data')
                    ->paginate(9);
            if (count($queryfiltro) == 0) {
                echo '<div  style="width:300px;text-align:center;margin:auto;" class="alert alert-info"><h4>No hi ha resultats de recerca</h4></div>';
            } else {
                ?>

                <!--                  <div id='busqueda_home'>
                                    <div id='ordenar_home'>
                                        {{ Form::open(array('url' => '/mevesnotes')) }}
                                        <fieldset>
                                            <legend>Buscar per</legend>
                                            <input name="cercarpubliques" placeholder='tag1,tag2,tag3..' id="cercarpubliques"  type="text">
                                            <input type="submit" class="btn btn-default" value="Enviar">
                                        </fieldset>
                                        {{ Form::close() }}
                                    </div>-->
            </div>
            <div class="js-packery" data-packery-options='{"rowHeight":60 ,"itemSelector": ".item", "percentPosition": true }'>
                <div class="grid-sizer"></div>  
                <?php
                for ($i = 0; $i < count($queryfiltro); $i++) {
                    $titolNota = $queryfiltro[$i]->titol;
                    $comentariNota = $queryfiltro[$i]->comentari;
                    $nick = $queryfiltro[$i]->nick;
                    $idnota = $queryfiltro[$i]->id;
                    $idModal = "Modal_".$i;
                    $queryCategories = DB::table('posts')   //Select que coge todos los tags de esa nota, porque una nota puede estar compuesta por mas de un tag
                            ->join('postscategories', 'posts.id', '=', 'postscategories.post_id')
                            ->join('categories', 'postscategories.categoria_id', '=', 'categories.id')
                            ->where('posts.id', $queryfiltro[$i]->id)
                            ->select('categories.nom')
                            ->paginate(10);
                    $categories = "";
                    for ($j = 0; $j < count($queryCategories); $j++) {
                        $categories = $categories . ',' . $queryCategories[$j]->nom;
                    }
                    $categories = substr($categories, 1);
                    ?>
                    <div class="item">
                        @include('includes/notapersonal')
                    </div>
                    <?php
                }
                ?>
            </div>
            <div style="width:100%;display:inline-block;text-align:center;padding-bottom:10px;">
                <?php echo $queryfiltro->links(); ?>
            </div>
            <?php
        }
    } else {
        //PONER QUERY DE ULTIMOS 10 POST.

        $query = DB::table('posts')
                ->join('usuaris', 'posts.usuari_id', '=', 'usuaris.id')
                ->where('usuaris.id', '=', Auth::user()->id)
                ->select('posts.id', 'posts.titol', 'posts.comentari', 'usuaris.nick', 'posts.data')
                ->paginate(9);

        if (count($query) == 0) {
            ?>
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

            <?php
        } else {
            ?>
            <div class="js-packery" data-packery-options='{"rowHeight":60 ,"itemSelector": ".item", "percentPosition": true }'>
                <div class="grid-sizer"></div>
                <?php
                for ($i = 0; $i < count($query); $i++) {
                    $titolNota = $query[$i]->titol;
                    $comentariNota = $query[$i]->comentari;
                    $nick = $query[$i]->nick;
                    $idnota = $query[$i]->id;
                    $idModal = "Modal_".$i;
                    $queryCategories = DB::table('posts')   //Select que coge todos los tags de esa nota, porque una nota puede estar compuesta por mas de un tag
                            ->join('postscategories', 'posts.id', '=', 'postscategories.post_id')
                            ->join('categories', 'postscategories.categoria_id', '=', 'categories.id')
                            ->where('posts.id', $query[$i]->id)
                            ->select('categories.nom')
                            ->paginate(10);
                    $categories = "";
                    for ($j = 0; $j < count($queryCategories); $j++) {
                        $categories = $categories . ", " . $queryCategories[$j]->nom;
                    }
                    $categories = substr($categories, 2);
                    ?>   
                    <div class="item">
                        @include('includes/notapersonal')
                    </div>
                    <?php
                }
                ?>
            </div>
            <div style="width:100%;display:inline-block;text-align:center;padding-bottom:10px;">
                <?php echo $query->links(); ?>
            </div>
            <?php
        }
    }
    ?>
</div>
<!--</div>-->
<script>
$(function () {

    $('#show-ordenar_home').on('click', function () {
        $('#busqueda_home').stop().slideToggle();
    });
});
</script>
@stop

