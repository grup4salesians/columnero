<?php

class CategoriaController extends BaseController {

    public function getSetpositions($categorias)
    {
        $categorias = explode('|', $categorias);
        for ($i=0; $i < count($categorias); $i++) { 
            CategoriesUsuari::where('usuaris_id', Auth::user()->id)->where('categories_id', $categorias[$i])
            ->update(array('mostrar' => $i));
        }

        //return var_dump($categorias);
        return Redirect::to('/');
    }

    public function getSetvisible($ids, $mostrar)
    {
        $ids = explode('|', $ids);
        $mostrar = explode('|', $mostrar);
        for ($i=0; $i < count($ids); $i++) { 
            if ($mostrar[$i] === 'null') {
                $mostrar[$i] = null;
            }
            CategoriesUsuari::where('usuaris_id', Auth::user()->id)->where('categories_id', $ids[$i])
            ->update(array('mostrar' => $mostrar[$i]));
        }

        //return var_dump($mostrar);
        return Redirect::to('/');
    }
}