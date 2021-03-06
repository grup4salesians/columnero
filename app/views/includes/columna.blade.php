<div  ng-controller="MainCtrl"  class="col-xs-12 col-sm-6 col-md-4 selector">
    <div class="panel columna panel-primary" data-column-id="{{ $idCategoria }}">
        <div class="panel-heading">
            <i title="Filtres" id="show-ordenar_home" class="fa fa-cog fa-1x show-ordenar_home"  data-column-id="{{ $idCategoria }}"></i>
        	<i title="Nova nota" ng-click="setAsTag({{ $categoria }})" id="newNotaBtn" class="fa fa-plus fa-1x" data-toggle="modal" data-target="#modalNewNota" data-cat-tag="{{ $categoria }}"></i>
            {{ $categoria }}
            <span class="count" data-idcol="{{ $idCategoria }}"></span>
        </div>

        <div id="column-{{ $idCategoria }}" data-categoria-id="{{ $idCategoria }}" data-position class="panel-body">
        	@include('includes/columnHomeOptions')
        	<ul class="list" style="margin-top: 15px;">
            <?php
            //Select que coge todos las notas del usuario y el tag

            if (isset($idCategoria)){
                $query = DB::table('usuaris')
                    ->join('posts', 'usuaris.id', '=', 'posts.usuari_id')
                    ->join('postscategories', 'posts.id', '=', 'postscategories.post_id')
                    ->join('categories', 'postscategories.categoria_id', '=', 'categories.id')
                    ->where('usuaris.id', '=', Auth::user()->id)
                    //->where('categories.nom',$categoria)    
                    ->where('categories.id', $idCategoria)
                    ->select('postscategories.post_id', 'posts.titol','posts.id', 'posts.comentari', 'posts.data', 'postscategories.categoria_id', 'categories.nom', 'usuaris.nick')
                    ->get();
            }
            else{
                $query = DB::table('usuaris')
                    ->join('posts', 'usuaris.id', '=', 'posts.usuari_id')
                    ->join('postscategories', 'posts.id', '=', 'postscategories.post_id')
                    ->join('categories', 'postscategories.categoria_id', '=', 'categories.id')
                    //->where('usuaris.id', '=', Auth::user()->id)
                    //->where('categories.nom',$categoria)    
                    //->where('categories.id', $idCategoria)
                    ->select('postscategories.post_id', 'posts.titol', 'posts.id','posts.comentari', 'posts.data', 'postscategories.categoria_id', 'categories.nom', 'usuaris.nick')
                    ->get();
            }

            echo '<div class="countNotas" style="display:none;" data-idcol="'.$idCategoria.'" data-count="'.count($query).'"></div>';
            for ($i = 0; $i < count($query); $i++) {
                $titolNota = $query[$i]->titol;
                $comentariNota = $query[$i]->comentari;
                $nick = $query[$i]->nick;
                $data = $query[$i]->data;
                $id = $query[$i]->id;
                $idModal = "Modal_".$id;    
                $idnota = $id;

                
                $queryCategories = DB::table('posts')   //Select que coge todos los tags de esa nota, porque una nota puede estar compuesta por mas de un tag
                        ->join('postscategories', 'posts.id', '=', 'postscategories.post_id')
                        ->join('categories', 'postscategories.categoria_id', '=', 'categories.id')
                        ->where('posts.id', $query[$i]->post_id)
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
            ?>
            </ul>
        </div>
    </div>
</div> 

<script>
	var options = {
      valueNames: [ 'panel-title', 'panel-body' ],
      indexAsync: true
    };

    var userList = new List('column8', options);


</script>
