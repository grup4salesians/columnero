@extends('layouts.master')
@section('title')
Notas publiques
@stop
@section('content')
<style>
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
</style>
<div id="contingut_home">
    <div class="row row-horizon">

        <?php
        if (!(empty($filtrodata))) {
            
        } else {
             if(Auth::user()->nick == $nick){
                $query = DB::table('posts')
                    ->join('usuaris', 'posts.usuari_id', '=', 'usuaris.id') 
                    ->where('nick','=',$nick)
                    ->select('posts.id', 'posts.titol','posts.comentari','usuaris.nick', 'posts.data')
                    ->paginate(9);        
            }else{
                 $query = DB::table('posts')
                    ->join('usuaris', 'posts.usuari_id', '=', 'usuaris.id') 
                    ->where('privat', 0)
                    ->where('nick','=',$nick)
                    ->select('posts.id', 'posts.titol','posts.comentari','usuaris.nick', 'posts.data')
                    ->paginate(9);
            }
            for ($i = 0; $i < count($query); $i++) {
                $titolNota = $query[$i]->titol;
                $comentariNota = $query[$i]->comentari;
                $nick = $query[$i]->nick;
                $data = $query[$i]->data;
                $queryCategories = DB::table('posts')   //Select que coge todos los tags de esa nota, porque una nota puede estar compuesta por mas de un tag
                        ->join('postscategories', 'posts.id', '=', 'postscategories.post_id')
                        ->join('categories', 'postscategories.categoria_id', '=', 'categories.id')
                        ->where('posts.id', $query[$i]->id)
                        ->select('categories.nom')
                       ->paginate(9);
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
            echo $query->links(); 
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

