@extends('layouts.master')
@section('title')
Notas publiques
@stop
@section('content')
<style>
    * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
</style>
<script src="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/packery/dist/packery.pkgd.min.js" type="text/javascript"></script>

<div id="contingut_home">
    <div class="row row-horizon">

        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Notes del usuari {{ $nick }}</h4>
            </div>
        </div>
        <?php
        if (!(empty($filtrodata))) {
            
        } else {
            if (Auth::user()->nick == $nick) {
                $query = DB::table('posts')
                        ->join('usuaris', 'posts.usuari_id', '=', 'usuaris.id')
                        ->where('nick', '=', $nick)
                        ->select('posts.id', 'posts.titol', 'posts.comentari', 'usuaris.nick', 'posts.data')
                        ->paginate(9);
            } else {
                $query = DB::table('posts')
                        ->join('usuaris', 'posts.usuari_id', '=', 'usuaris.id')
                        ->where('privat', 0)
                        ->where('nick', '=', $nick)
                        ->select('posts.id', 'posts.titol', 'posts.comentari', 'usuaris.nick', 'posts.data')
                        ->paginate(9);
            }
            ?>
            <div class="js-packery" data-packery-options='{"rowHeight":60 ,"itemSelector": ".item", "percentPosition": true }'>
                <div class="grid-sizer"></div>  

                <?php
                for ($i = 0; $i < count($query); $i++) {
                    $titolNota = $query[$i]->titol;
                    $comentariNota = $query[$i]->comentari;
                    $nick = $query[$i]->nick;
                    $data = $query[$i]->data;
                    $id = $query[$i]->id;
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
                    <?php
                }
                ?>
            </div>
            <div style="width:100%;float:left;display:inline-block;">
                <?php echo $query->links(); ?>
            </div>
        <?php }
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

