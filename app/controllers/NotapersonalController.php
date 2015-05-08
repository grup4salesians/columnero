<?php

class NotapersonalController extends BaseController {


    public function EliminarNota($id) {
      PostCategorie::where('post_id', '=', $id)->delete();
      Post::where('id', '=', $id)->delete();
      
       return Redirect::back();  
    }
    
    public function EditarNota($id){
        
        return Redirect::back();
    }

}

?>