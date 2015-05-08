<?php

class NovanotaController extends BaseController {

    public function ShowNovaNota() {
        return View::make('pages.novanota');
    }
    
    public function PostNovaNota(){
         $variables = array(
            'Titol' => Input::get('Titol'),
            'ListadoTags' => Input::get('ListadoTags'),
            'TexoNota' => Input::get('TextoNota')
        );
         
            return Redirect::back()->withInput()->withErrors($validator);
        
    }
    
    

    public function selectcategories($query) {
        $categories = Categorie::where("nom", 'LIKE', "%" . $query . "%")->select("nom")->get();
        return array('Error' => MirarError($categories), 'Categories' => $categories);
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