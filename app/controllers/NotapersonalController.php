<?php

class NotapersonalController extends BaseController {

    public function EliminarNota($id) {
        $PostDeleted = 56;
        $idvaloracionsPostBorrar = 0;

        if ($id == $PostDeleted) {    //No se borra la de "ESTE POST HA SIDO BORRADO"
            valoracions::where('post_id', $PostDeleted)->where('usuari_id', Auth::user()->id)->delete();
        } else {

            PostCategorie::where('post_id', '=', $id)->delete(); //Borramos las relaciones del post con una o mas categorias
            //Hacemos un select para saber el idvaloracio que vamos a borrar
            $query = valoracions::where('post_id', '=', $id)->where('usuari_id', '=', Auth::user()->id)->select('id')->get();

            if (count($query) > 0) {   //Si el usuario que ha creado el propio post, se lo ha puesto como favorito
                $idvaloracionsPostBorrar = $query[0]->id;
            }

            //Actualizamos a los usuarios que tenían el post como favorito a el post de "este post a sido borrado"
            valoracions::where('post_id', '=', $id)->update(array('post_id' => $PostDeleted));

            if ($idvaloracionsPostBorrar > 0) {
                //Borramos la valoracio del post que quería eliminar el usuario desde un principio
                valoracions::where('id', $idvaloracionsPostBorrar)->delete();
            }
            Post::where('id', '=', $id)->delete(); //Borramos el post
        }

        return Redirect::back();
    }

    public function ShowMevesNotes() {
        $tags = explode(',', Input::get('cercarpubliques'));


        return View::make('pages.mevesnotes')->with('tags', $tags);
    }

    public function EditarNota($id) {
        return View::make('pages.editarnota')->with('id', $id);
    }

    public function PostEditarNota($id) {
        $PostDeleted = 56;
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
        if ($optionradio == 0) {
            Post::where('usuari_id', '=', Auth::user()->id)->where('id', '=', $id)->update(array('comentari' => $textonota, 'titol' => $titol, 'privat' => 0));
            
        } else {
            Post::where('usuari_id', '=', Auth::user()->id)->where('id', '=', $id)->update(array('comentari' => $textonota, 'titol' => $titol, 'privat' => 1));
             valoracions::where('post_id', '=', $id)->where('usuari_id','<>',Auth::user()->id)->update(array('post_id' => $PostDeleted));
        }


        $ArrayTags = explode("|", $tags);

        for ($i = 0; $i < count($ArrayTags) - 1; $i++) {


            PostCategorie::where('post_id', '=', $id)->delete();
            Post::where('usuari_id', '=', Auth::user()->id)->where('id', '=', $id)->update(array('comentari' => $textonota, 'titol' => $titol));


            $ArrayTags = explode("|", $tags);

            for ($i = 0; $i < count($ArrayTags) - 1; $i++) {
                $query = DB::table('categories')
                        ->join('categoriesusuaris', 'categories.id', '=', 'categoriesusuaris.categories_id')
                        ->where('categoriesusuaris.usuaris_id', Auth::user()->id)
                        ->where('categories.nom', $ArrayTags[$i])
                        ->select('categoriesusuaris.categories_id')
                        ->get();

                if (count($query) == 0) { //Si no existe la categoria, inserta en tablas; categories,CategoriesUsuaris
                    $CategoriaNueva = new Categorie();
                    $CategoriaNueva->nom = $ArrayTags[$i];
                    $CategoriaNueva->save();

                    $idCategoria = $CategoriaNueva->id; //Coge la id del que acabamos de insertar

                    $CategoriaUsuarioNueva = new CategoriesUsuari();
                    $CategoriaUsuarioNueva->categories_id = $idCategoria;
                    $CategoriaUsuarioNueva->usuaris_id = Auth::user()->id;
                    $CategoriaUsuarioNueva->mostrar = 0;
                    $CategoriaUsuarioNueva->save();
                } else {
                    $idCategoria = $query[0]->categories_id;
                }

                $PostCategoriaNueva = new PostCategorie();
                $PostCategoriaNueva->categoria_id = $idCategoria;
                $PostCategoriaNueva->post_id = $id;

                $PostCategoriaNueva->save();
            }
            return Redirect::to('mevesnotes');
        }
    }

}

?>