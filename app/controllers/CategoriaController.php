<?php

class CategoriaController extends BaseController {

    public function getSetpositions($categorias)
    {
        $categorias = explode('|', $categorias);
        for ($i=0; $i < count($categorias); $i++) { 
            CategoriesUsuari::where('usuaris_id', Auth::user()->id)->where('categories_id', $categorias[$i])
            ->update(array('mostrar' => $i));
        }

        return var_dump($categorias);

    }
}