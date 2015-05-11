@extends('layouts.master')
@section('title')
Home
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
    #ordenar_home{
        width:250px;
        height:100px;
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
                    ->paginate(10);

            for ($i = 0; $i < count($queryfiltro); $i++) {
                $titolNota = $queryfiltro[$i]->titol;
                $comentariNota = $queryfiltro[$i]->comentari;
                $nick = $queryfiltro[$i]->nick;
                $data = $queryfiltro[$i]->data;

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
                <div class="col-xs-12 col-sm-5 col-md-4" style="float:left; display:block;">
                    @include('includes/nota')
                </div>
        
       
                <?php
            }
            echo $queryfiltro->links(); 
            ?>



        <?php
        } else {
            //PONER QUERY DE ULTIMOS 10 POST por defecto que sean públicos.

            $query = DB::table('posts')
                    ->join('usuaris', 'posts.usuari_id', '=', 'usuaris.id')
                    ->where('privat', 0)
                    ->select('posts.id', 'posts.titol', 'posts.comentari', 'usuaris.nick', 'posts.data')
                    ->take(10)
                    ->paginate(10);

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

