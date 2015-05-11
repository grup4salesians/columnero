<?php

class NotapersonalController extends BaseController {

    public function EliminarNota($id) {
        PostCategorie::where('post_id', '=', $id)->delete();
        Valoracions::where('post_id','=',$id)->delete();
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
            'TextoNota' => Input::get('TextoNota')
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
        
        PostCategorie::where('post_id', '=', $id)->delete();
        Post::where('usuari_id', '=', $id)->update(array('comentari' => $textonota, 'titol', $titol));
        
        $ArrayTags = explode('|', $tags);
        
        $contador = count($ArrayTags);
        
        for ($i = 0; $i < $contador; $i++) {
            $query = DB::table('categories')
                    ->join('categoriesusuaris', 'categories.id', '=', 'categoriesusuaris.categories_id')
                    ->where('categoriesusuaris.usuaris_id', Auth::user()->id)
                    ->where('categories.nom', $tags[$i])
                    ->select('categoriesusuaris.categories_id')
                    ->get();

            $idCategoria = $query[0]->categories_id;
            if (count($query) == 0) { //Si no existe la categoria, inserta en tablas; categories,CategoriesUsuaris
                $CategoriaNueva = new Categorie();
                $CategoriaNueva->nom = $titol;
                $CategoriaNueva->save();

                $idCategoria = $CategoriaNueva->id; //Coge la id del que acabamos de insertar

                $CategoriaUsuarioNueva = new CategoriesUsuari();
                $CategoriaUsuarioNueva->categories_id = $idCategoria;
                $CategoriaUsuarioNueva->usuaris_id = $ID_Usuari;
                $CategoriaUsuarioNueva->save();
            }

            $PostCategoriaNueva = new PostCategorie();
            $PostCategoriaNueva->categoria_id = $idCategoria;
            $PostCategoriaNueva->post_id = $idPost;
            $postcategoria = new PostCategorie();
        }
        return View::make('pages.mevesnotes');
    }

}

?>