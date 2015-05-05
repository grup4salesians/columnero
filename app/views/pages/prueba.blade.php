<?php

$query = Usuari::where("id", 2)->with("Post")->select();
$datosQuery = $query->get();

for ($i=0; $i<count($datosQuery[0]->post);$i++){
    echo $datosQuery[0]->post[$i]->titol;
}
echo "</br>";
$query = PostCategorie::where("post_id", 2)->with("Post")->select();
$datosQuery1 = $query->get();

echo $datosQuery1;
?>


