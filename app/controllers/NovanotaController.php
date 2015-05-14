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
        $Public = Input::get('optionsRadios');
        
        $PostNuevo = new Post();
        $PostNuevo->titol = $titol;
        $PostNuevo->comentari = $TextoNota;
        $PostNuevo->usuari_id = $ID_Usuari;
        $PostNuevo->data = date("Y-m-d H:i:s");
        $PostNuevo->privat = $Public;
        $PostNuevo->save();
        
        $idPost = $PostNuevo->id;
                
        $ArrayTags = explode("|",$ListadoTags);
        
        for($i=0;$i<count($ArrayTags)-1;$i++){
            $query = DB::table('categories')
                    ->join('categoriesusuaris','categories.id','=','categoriesusuaris.categories_id')
                    ->where('categoriesusuaris.usuaris_id',$ID_Usuari)
                    ->where('categories.nom',$ArrayTags[$i])
                    ->select('categoriesusuaris.categories_id')
                    ->get();
        
            if (count($query)==0){ //Si no existe la categoria, inserta en tablas; categories,CategoriesUsuaris
                $CategoriaNueva = new Categorie();
                $CategoriaNueva->nom = $ArrayTags[$i];
                $CategoriaNueva->save();
                
                $idCategoria =  $CategoriaNueva->id; //Coge la id del que acabamos de insertar
                 
                $CategoriaUsuarioNueva = new CategoriesUsuari();
                $CategoriaUsuarioNueva->categories_id = $idCategoria;
                $CategoriaUsuarioNueva->usuaris_id = $ID_Usuari;
                $CategoriaUsuarioNueva->mostrar =null;
                $CategoriaUsuarioNueva->save();
            }
            else{
                   $idCategoria = $query[0]->categories_id;
            }

            $PostCategoriaNueva = new PostCategorie();
            $PostCategoriaNueva->categoria_id= $idCategoria;
            $PostCategoriaNueva->post_id = $idPost;
               
            $PostCategoriaNueva->save();
            //return Redirect::back()->withInput()->withErrors($ListadoTags);
        };
         return Redirect::to('/');                
       
        
    }
           
    public function selectcategories($query) {
        $categories = DB::table('categories')
                    ->join('categoriesusuaris','categories.id','=','categoriesusuaris.categories_id')
                    ->where('categoriesusuaris.usuaris_id',Auth::user()->id)
                    ->where("nom", 'LIKE', "%" . $query . "%")
                    ->select("nom as text")->get();
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