@extends('layouts.master')
@section('title')
Home
@stop
@section('content')
<style>
    * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
</style>
<script>
    $(document).ready(function() {
        $('.cl-menu-publiques').css('background-color', '#F0677C');
    });
</script>
<script src="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/packery/dist/packery.pkgd.min.js" type="text/javascript"></script>

<div id="contingut_home">
    <div>
        <div id='busqueda_home'>
            <div id='ordenar_home'>
                {{ Form::open(array('url' => '/publiques')) }}

                <fieldset>
                    <legend>Buscar per</legend>
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
        if (!(empty($tags))) {

            $queryfiltro = DB::table('posts')
                    ->join('usuaris', 'posts.usuari_id', '=', 'usuaris.id')
                    ->join('postscategories', 'posts.id', '=', 'postscategories.post_id')
                    ->join('categories', 'postscategories.categoria_id', '=', 'categories.id')
                    ->where('posts.privat', 0)
                    ->whereIn('categories.nom', $tags)
                    ->select('posts.id', 'posts.titol', 'posts.comentari', 'usuaris.nick', 'posts.data')
                    ->paginate(9);
            if (count($queryfiltro) == 0) {
                echo '<div  style="width:300px;text-align:center;margin:auto;" class="alert alert-info"><h4>No hi ha resultats de recerca</h4></div>';
            } else {
                ?>
                <div class="js-packery" data-packery-options='{"rowHeight":60 ,"itemSelector": ".item", "percentPosition": true }'>
                    <div class="grid-sizer"></div>  
                    <?php
                    for ($i = 0; $i < count($queryfiltro); $i++) {
                        $titolNota = $queryfiltro[$i]->titol;
                        $comentariNota = $queryfiltro[$i]->comentari;
                        $nick = $queryfiltro[$i]->nick;
                        $data = $queryfiltro[$i]->data;
                        $id = $queryfiltro[$i]->id;
                        $idModal = "Modal_".$i;    
                        $idnota = $id;
                
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
                <div style="width:100%;float:left;display:inline-block;text-align:center;padding-bottom:10px;">
                    <?php echo $queryfiltro->links(); ?>
                </div>
                <?php
                ?>



                <?php
            }
        } else {
            //PONER QUERY DE ULTIMOS 10 POST por defecto que sean públicos.

            $query = DB::table('posts')
                    ->join('usuaris', 'posts.usuari_id', '=', 'usuaris.id')
                    ->where('privat', 0)
                    ->select('posts.id', 'posts.titol', 'posts.comentari', 'usuaris.nick', 'posts.data')
                    ->take(10)
                    ->paginate(9);
            ?>
            <div class="js-packery" data-packery-options='{"rowHeight":60 ,"itemSelector": ".item", "percentPosition": true }'>
                <div class="grid-sizer"></div> <?php
                for ($i = 0; $i < count($query); $i++) {
                    $titolNota = $query[$i]->titol;
                    $comentariNota = $query[$i]->comentari;
                    $nick = $query[$i]->nick;
                    $data = $query[$i]->data;
                    $id = $query[$i]->id;
                    $idModal = "Modal_".$i;    
                    $idnota = $id;
                
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
                    <div class="item">
                        @include('includes/nota')
                    </div>     


                <?php }
                ?>
            </div>
            <div style="width:100%;float:left;display:inline-block;text-align:center;padding-bottom:10px;">
                <?php echo $query->links(); ?>
            </div>
        <?php }
        ?>
    </div>
</div>

@stop

