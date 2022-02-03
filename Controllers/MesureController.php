<?php
$jour = ["Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi"];

require ('__DIR__/../Models/MesureModel.php');
$uneMesure = new MesureModel();




function topFroidS(){
$uneMesure = new MesureModel();  
$cold=$uneMesure->topFroidSemaine();

return $cold;
}
$cold=topFroidS();
$colddate = $uneMesure -> dateComplete($cold["jour"]);


function topChaud() {

    $MesureModel = new MesureModel();
    $Mesure = $MesureModel -> topChaudSemaine();
    
    return $Mesure;
} 
$hot =topChaud();
$hotdate = $uneMesure -> dateComplete($hot["jour"]);

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
