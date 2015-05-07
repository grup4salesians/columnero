<?php

class NovanotaController extends BaseController {
     public function selectcategories($query){
        $categories = Categorie::where("nom",'LIKE', "%" . $query . "%")->select("nom")->get();          
        return array('Error'=>MirarError($categories),'Categories'=> $categories);
        //return Response::json(array('Error'=>"res",'Viatge'=> "deres"),200);
       
    }
}
?>
<?php
function MirarError($valor){
        if (count($valor)){$error = 0;}
        else{ $error = 1; }
        return $error;
}
?>