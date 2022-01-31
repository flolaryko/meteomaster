<?php

require ('__DIR__/../Models/MesureModel.php');
$uneMesure = new MesureModel();

function topFroidS(){
$uneMesure = new MesureModel();  
$cold=$uneMesure->topFroidSemaine();

return $cold;
}

$cold=topFroidS();


function topChaud() {

    $MesureModel = new MesureModel();
    $Mesure = $MesureModel -> topChaudSemaine();
    
    return $Mesure;
} 
$hot =topChaud();


