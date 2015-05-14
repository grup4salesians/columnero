<?php

class NotapersonalController extends BaseController {

    public function EliminarNota($id) {
        PostCategorie::where('post_id', '=', $id)->delete();
        Valoracions::where('post_id','=',$id)->where('usuari_id','=',Auth::user()->id)->delete();
        Post::where('id', '=', $id)->delete();

        return Redirect::back();
    }
    
    public function ShowMevesNotes(){
                $tags = explode(',',Input::get('cercarpubliques'));
                          
                       
                    return View::make('pages.mevesnotes')->with('tags',$tags);
    }

    public function EditarNota($id) {
        return View::make('pages.editarnota')->with('id', $id);
    }

    public function PostEditarNota($id) {
        $variables = array(
            'Titol' => Input::get('Titol'),
            'ListadoTags' => Input::get('ListadoTagsOculto'),
            'TextoNota' => Input::get('TextoNota'),
            'optionsRadios' => Input::get('optionsRadios')
            
        );
        $rules = [
            'Titol' => 'required|min:1',
            'ListadoTags' => 'required|min:1',
            'TextoNota' => 'required|min:1'
        ];
        $validator = Validator::make($variables, $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        
        $textonota = Input::get('TextoNota');
        $titol = Input::get('Titol');
        $tags = Input::get('ListadoTagsOculto');
       $optionradio = Input::get('optionsRadios');
        
        PostCategorie::where('post_id', '=', $id)->delete();
        if($optionradio == 0){
            Post::where('usuari_id', '=', Auth::user()->id)->where('id','=',$id)->update(array('comentari' => $textonota, 'titol' => $titol, 'privat' => 0)); 
        }else{
             Post::where('usuari_id', '=', Auth::user()->id)->where('id','=',$id)->update(array('comentari' => $textonota, 'titol' => $titol, 'privat' => 1));
        }
       
        
         
        $ArrayTags = explode("|",$tags);
        
        for($i=0;$i<count($ArrayTags)-1;$i++){
            $query = DB::table('categories')
                    ->join('categoriesusuaris','categories.id','=','categoriesusuaris.categories_id')
                    ->where('categoriesusuaris.usuaris_id',Auth::user()->id)
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
                $CategoriaUsuarioNueva->usuaris_id = Auth::user()->id;
                $CategoriaUsuarioNueva->mostrar =0;
                $CategoriaUsuarioNueva->save();
            }
            else{
                   $idCategoria = $query[0]->categories_id;
            }

            $PostCategoriaNueva = new PostCategorie();
            $PostCategoriaNueva->categoria_id= $idCategoria;
            $PostCategoriaNueva->post_id = $id;
               
            $PostCategoriaNueva->save();
        }
        return Redirect::to('mevesnotes');
    }

}

?>