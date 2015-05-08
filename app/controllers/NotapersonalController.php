<?php

class NotapersonalController extends BaseController {


    public function EliminarNota($id) {
      PostCategorie::where('post_id', '=', $id)->delete();
      Post::where('id', '=', $id)->delete();
      
       return Redirect::back();  
    }
    
    public function EditarNota($id){       
       return View::make('pages.editarnota')->with('id',$id);
    }
    
    public function PostEditarNota($id)
    {
                $variables = array(
            'Titol' => Input::get('Titol'),
            'ListadoTags' => Input::get('ListadoTagsOculto'),
            'TexoNota' => Input::get('TextoNota')
        );
                $textonota = Input::get('TextoNota');
                $titol = Input::get('Titol');
                $tags = Input::get('ListadoTagsOculto');
         PostCategorie::where('post_id','=',$id)->delete();      
         Post::where('usuari_id','=',$id)->update(array('comentari' => $textonota,'titol',$titol));
        $postcategoria = new PostCategorie();
        
                return View::make('pages.mevesnotes');
    }

}

?>