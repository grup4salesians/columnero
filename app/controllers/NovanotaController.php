<?php

class NovanotaController extends BaseController {

    public function ShowNovaNota() {
        return View::make('pages.novanota');
    }
    
    public function PostNovaNota(){
        
         $notadata = array(
            'titol' => Input::get('Titol'),
            'ListadoTags' => Input::get('ListadoTagsOculto'),
            'TextoNota' => Input::get('TextoNota')
        );
        $rules = [
            'titol' => 'required|min:1',
            'ListadoTags' => 'required|min:1',
            'TextoNota' => 'required|min:1'
        ];
        $validator = Validator::make($notadata, $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        
        $titol = Input::get('Titol');
        $ListadoTags = Input::get('ListadoTagsOculto');
        $TextoNota = Input::get('TextoNota');
        $ID_Usuari = Auth::user()->id;
        
        $PostNuevo = new Post();
        $PostNuevo->titol = $titol;
        $PostNuevo->comentari = $TextoNota;
        $PostNuevo->usuari_id = $ID_Usuari;
        $PostNuevo->data = date("Y-m-d H:i:s");
        $PostNuevo->save();
        
        $idPost = $PostNuevo->id;
                
        $ArrayTags = explode('|',$ListadoTags);
        
        for($i=0;count($ArrayTags)-1;$i++){
            $query = DB::table('categories')
                    ->join('categoriesusuaris','categories.id','=','categoriesusuaris.categories_id')
                    ->where('categoriesusuaris.usuaris_id',$ID_Usuari)
                    ->where('categories.nom',$titol)
                    ->select('categoriesusuaris.categories_id')
                    ->get();
            
            $idCategoria = $query[0]->categories_id;
            if (count($query)==0){ //Si no existe la categoria, inserta en tablas; categories,CategoriesUsuaris
                $CategoriaNueva = new Categorie();
                $CategoriaNueva->nom = $titol;
                $CategoriaNueva->save();
                
                $idCategoria =  $CategoriaNueva->id; //Coge la id del que acabamos de insertar
                 
                $CategoriaUsuarioNueva = new CategoriesUsuari();
                $CategoriaUsuarioNueva->categories_id = $idCategoria;
                $CategoriaUsuarioNueva->usuaris_id = $ID_Usuari;
                $CategoriaUsuarioNueva->save();
            }

            $PostCategoriaNueva = new PostCategorie();
            $PostCategoriaNueva->categoria_id= $idCategoria;
            $PostCategoriaNueva->post_id = $idPost;
            
        };
                        
        //return Redirect::back()->withInput()->withErrors(Input::get('ListadoTagsOculto'));
        
    }
           
    public function selectcategories($query) {
        $categories = Categorie::where("nom", 'LIKE', "%" . $query . "%")->select("nom as text")->get();
        return $categories;
        //return Response::json(array('Error'=>"res",'Viatge'=> "deres"),200);
    }

}

?>
<?php

function MirarError($valor) {
    if (count($valor)) {
        $error = 0;
    } else {
        $error = 1;
    }
    return $error;
}

?>