<div class="col-md-4">
    <div class="panel columna panel-primary">
        <div class="panel-heading">
            {{ $categoria }}
        </div>

        <div class="panel-body">
            <?php   //Select que coge todos las notas del usuario y el tag
                $query = DB::table('usuaris')
                    ->join('posts','usuaris.id','=','posts.usuari_id')
                    ->join('postscategories','posts.id','=','postscategories.post_id')
                    ->join('categories','postscategories.categoria_id','=','categories.id')
                    ->where('usuaris.id','=',Auth::user()->id)
                    ->where('categories.nom',$categoria)    
                    ->select('postscategories.post_id','posts.titol','posts.comentari','posts.data','postscategories.categoria_id','categories.nom','usuaris.nick')
                    ->get();
            for($i=0;$i<count($query);$i++){
                $titolNota = $query[$i]->titol;
                $comentariNota = $query[$i]->comentari;
                $nick = $query[$i]->nick;
                
                $queryCategories = DB::table('posts')   //Select que coge todos los tags de esa nota, porque una nota puede estar compuesta por mas de un tag
                    ->join('postscategories','posts.id','=','postscategories.post_id')
                    ->join('categories','postscategories.categoria_id','=','categories.id')
                    ->where('posts.id',$query[$i]->post_id)
                    ->select('categories.nom')
                    ->get();
                $categories ="";
                for($j=0;$j<count($queryCategories);$j++){
                    $categories= $categories .", ". $queryCategories[$j]->nom;
                 }
                $categories = substr($categories,2);
            ?>   
 
            @include('includes/nota')
            <?php
               }    
            ?>
        </div>
    </div>
</div> 
