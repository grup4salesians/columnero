@extends('layouts.master')
@section('title')
Preferits
@stop
@section('content')
<style>
    * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    #ordenar_home{
        width:300px;
        height:120px;
    }
</style>
<script src="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/packery/dist/packery.pkgd.min.js" type="text/javascript"></script>

<?php
$queryvaloracions = DB::table('posts')
        ->join('valoracions', 'posts.id', '=', 'valoracions.post_id')
        ->join('usuaris', 'valoracions.usuari_id', '=', 'usuaris.id')
        ->where('valoracions.usuari_id', '=', Auth::user()->id)
        ->where('valoracions.favorit', '=', 1)
        ->select('posts.id', 'posts.titol', 'posts.comentari', 'posts.usuari_id', 'posts.data', 'usuaris.nick', 'posts.data')
        ->get();

if (count($queryvaloracions) == 0) {
    ?>
    <div class="col-md-4 col-sm-2 col-xs-0">
    </div>
    <div class="col-md-4 col-sm-8 col-xs-12" style="padding-top: 16%;">
        <div class="dashboard-div-wrapper bk-clr-two">
            <i class="fa fa-star" style="font-size:30px;"></i>
            <h5 class="linkAlert">No tens cap favorit!</h5>
        </div>
    </div>
    <div class="col-md-4 col-sm-2 col-xs-0">
        <?php
    } else {
        ?>
        <div id='busqueda_home'>
            <div id='ordenar_home'>
                {{ Form::open(array('url' => '/preferits')) }}
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
                    ->join('valoracions', 'posts.id', '=', 'valoracions.post_id')
                    ->where('valoracions.favorit', '=', 1)
                    ->where('valoracions.usuari_id', '=', Auth::user()->id)
                    ->where('posts.privat', '=', 0)
                    ->whereIn('categories.nom', $tags)
                    ->select('posts.id', 'posts.titol', 'posts.comentari', 'usuaris.nick', 'posts.data')
                    ->paginate(9);

            if (count($queryfiltro) == 0) {
                echo '<div  style="width:300px;text-align:center;margin:auto;" class="alert alert-info"><h4>No hi ha resultats de recerca</h4></div>';
            } else {
                ?>
                <div class="js-packery" data-packery-options='{ "columnWidth": 90, "rowHeight":60 ,"itemSelector": ".item", "percentPosition": true }'>
                    <div class="grid-sizer"></div>
                    <?php
                    for ($i = 0; $i < count($queryfiltro); $i++) {
                        $macuco = DB::table('posts')
                                ->join('usuaris', 'posts.usuari_id', '=', 'usuaris.id')
                                ->where('posts.id', $queryfiltro[0]->id)
                                ->select('usuaris.nick')
                                ->get();

                        $titolNota = $queryfiltro[$i]->titol;
                        $comentariNota = $queryfiltro[$i]->comentari;
                        $nick = $macuco[0]->nick;
                        $id = $queryfiltro[$i]->id;
                        $data = $queryfiltro[$i]->data;

                        $queryCategories = DB::table('posts')   //Select que coge todos los tags de esa nota, porque una nota puede estar compuesta por mas de un tag
                                ->join('postscategories', 'posts.id', '=', 'postscategories.post_id')
                                ->join('categories', 'postscategories.categoria_id', '=', 'categories.id')
                                ->where('posts.id', $queryfiltro[$i]->id)
                                ->select('categories.nom')
                                ->get();

                        $categories = "";
                        for ($j = 0; $j < count($queryCategories); $j++) {
                            $categories = $categories . ',' . $queryCategories[$j]->nom;
                        }
                        $categories = substr($categories, 1);
                        ?>
                        <div class="item">
                            @include('includes/nota')
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
                echo $queryfiltro->links();
            }
        } else {
            ?>
            <div class="js-packery" data-packery-options='{ "columnWidth": 90, "rowHeight":60 ,"itemSelector": ".item", "percentPosition": true }'>
                <div class="grid-sizer"></div>
                <?php
                for ($i = 0; $i < count($queryvaloracions); $i++) {

                    $macuco = DB::table('posts')
                            ->join('usuaris', 'posts.usuari_id', '=', 'usuaris.id')
                            ->where('posts.id', $queryvaloracions[$i]->id)
                            ->select('usuaris.nick')
                            ->get();

                    $titolNota = $queryvaloracions[$i]->titol;
                    $comentariNota = $queryvaloracions[$i]->comentari;
                    $nick = $macuco[0]->nick;
                    $id = $queryvaloracions[$i]->id;
                    $data = $queryvaloracions[$i]->data;

                    $queryCategories = DB::table('posts')   //Select que coge todos los tags de esa nota, porque una nota puede estar compuesta por mas de un tag
                            ->join('postscategories', 'posts.id', '=', 'postscategories.post_id')
                            ->join('categories', 'postscategories.categoria_id', '=', 'categories.id')
                            ->join('valoracions', 'posts.id', '=', 'valoracions.post_id')
                            ->where('posts.id', $queryvaloracions[$i]->id)
                            ->where('valoracions.favorit', '=', 1)
                            ->select('categories.nom')
                            ->paginate(10);
                    $categories = "";
                    for ($j = 0; $j < count($queryCategories); $j++) {
                        $categories = $categories . ", " . $queryCategories[$j]->nom;
                    }
                    $categories = substr($categories, 2);
                    ?>   
                    <div class="item">
                        @include('includes/nota')
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
            echo $queryCategories->links();
        }
    }
    ?>

</div>
@stop