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


function allNomMesure(){
    $allMesure=new MesureModel();
    $allMesures=$allMesure->All_Nom_Mesure();

    return $allMesures;
}
$allM=allNomMesure();
 

function UneMesureComp($libelleLieu,$dateDebut, $dateFin,$mesure){

    $mesureComp=new MesureModel();
    $UneMesureComp=$mesureComp->Une_Mesure_Comp($libelleLieu,$dateDebut, $dateFin,$mesure);

    return $UneMesureComp;
}
