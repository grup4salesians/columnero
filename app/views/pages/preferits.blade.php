@extends('layouts.master')
@section('title')
Preferits
@stop
@section('content')

<?php
$queryvaloracions = DB::table('posts')
        ->join('valoracions','posts.id','=','valoracions.post_id')
        ->join('usuaris','valoracions.usuari_id','=','usuaris.id')
        ->where('valoracions.usuari_id', '=', Auth::user()->id)
        ->where('valoracions.favorit', '=', 1)
        ->select('posts.id','posts.titol','posts.comentari','posts.usuari_id','posts.data','usuaris.nick','posts.data')
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
        for ($i = 0; $i < count($queryvaloracions); $i++) {
                    $titolNota = $queryvaloracions[$i]->titol;
                    $comentariNota = $queryvaloracions[$i]->comentari;
                    $nick = $queryvaloracions[$i]->nick;
                    $id = $queryvaloracions[$i]->id;
                    $data = $queryvaloracions[$i]->data;
                    

                    $queryCategories = DB::table('posts')   //Select que coge todos los tags de esa nota, porque una nota puede estar compuesta por mas de un tag
                            ->join('postscategories', 'posts.id', '=', 'postscategories.post_id')
                            ->join('categories', 'postscategories.categoria_id', '=', 'categories.id')
                            ->join('valoracions', 'posts.id', '=', 'valoracions.post_id')
                            ->where('posts.id', $queryvaloracions[$i]->id)
                            ->where('valoracions.favorit','=', 1)
                            ->select('categories.nom')
                            ->paginate(10);
                    $categories = "";
                    for ($j = 0; $j < count($queryCategories); $j++) {
                        $categories = $categories . ", " . $queryCategories[$j]->nom;
                    }
                    $categories = substr($categories, 2);
                    ?>   
                    <div class="col-xs-12 col-sm-5 col-md-4" style="float:left; display:block;">
                        @include('includes/nota')
                    </div>
                    <?php
                }
                echo $queryCategories->links();
    }
    ?>


</div>
@stop