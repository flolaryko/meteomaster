<?php
require ('__DIR__/../Models/MesureModel.php');
$uneMesure = new MesureModel();



// récupérer le jour le plus froid
function topFroidS(){
$uneMesure = new MesureModel();  
$cold=$uneMesure->topFroidSemaine();

return $cold;
}
$cold=topFroidS();
$colddate = $uneMesure -> dateComplete($cold["jour"]);

// récupérer le jour le plus chaud
function topChaud() {

    $MesureModel = new MesureModel();
    $Mesure = $MesureModel -> topChaudSemaine();
    
    return $Mesure;
} 
$hot =topChaud();
$hotdate = $uneMesure -> dateComplete($hot["jour"]);

// récupérer les noms de champs de la table mesure
function allNomMesure(){
    $allMesure=new MesureModel();
    $allMesures=$allMesure->All_Nom_Mesure();

    return $allMesures;
}
$allM=allNomMesure();
 
// récupérer toutes les données d'une mesure sur un temps défini et un lieu
function UneMesureComp($libelleLieu,$dateDebut, $dateFin,$mesure){

    $mesureComp=new MesureModel();
    $UneMesureComp=$mesureComp->Une_Mesure_Comp($libelleLieu,$dateDebut, $dateFin,$mesure);

    return $UneMesureComp;
}
