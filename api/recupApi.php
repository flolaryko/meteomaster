<?php
// récupération des données méteo et ajout dans la base
require('../Models/LieuModel.php');
require('../Models/MesureModel.php'); 
require('../Models/MeteoModel.php');
$uneMesure = new MesureModel(); 
$uneMeteo = new MeteoModel();
$unLieu = new LieuModel();



$Lieux = $unLieu -> All_Lieux();

try {

foreach ($Lieux as $lieu) {

    $url_api = 'https://api.openweathermap.org/data/2.5/onecall?lat=' . $lieu['latitude'] . '&lon=' . $lieu['longitude'] . '&appid=273b150084efde797ba71126e1898096&units=metric&lang=fr&exclude=minutely,hourly,daily';
    $json=file_get_contents($url_api);
    $tab=json_decode($json,true); 

    $DateMesure= date('Y-m-d', $tab["current"]["dt"]);
    $HeureMesure= date('H:i:s', $tab["current"]["dt"]);
    $leveSoleil=date('H:i:s', $tab["current"]["sunrise"]);
    $coucheSoleil=date('H:i:s', $tab["current"]["sunset"]);
    $temperature= $tab["current"]["temp"];
    $tempRessenti=$tab["current"]["feels_like"];
    $pression=$tab["current"]["pressure"]; // en hPa
    $humidite=$tab["current"]["humidity"]; // en %
    $nebulosite=$tab["current"]["clouds"]; // en octa
    $visibilite=$tab["current"]["visibility"]; // en mètres
    $vitesseVent= isset($tab["current"]["wind_speed"]) ? $tab["current"]["wind_speed"] : 0;// en m/s
    $directionVent=isset($tab["current"]["wind_deg"]) ? $tab["current"]["wind_deg"] : 0; // en °
    $rafaleVent= isset($tab["current"]["wind_gust"]) ? $tab["current"]["wind_gust"] : 0 ; // en m/s
    $libelleMeteo = $tab["current"]["weather"][0]["main"]; 
    $descriptionMeteo = $tab["current"]["weather"][0]["description"];
    $iconMeteo = $tab["current"]["weather"][0]["icon"];
    $pluie = isset($tab["current"]["rain"]) ? $tab["current"]["rain"] : 0;
    $pluie3h = isset($tab["current"]["rain"]) ? $tab["current"]["rain"] : 0;
    $idMeteo = $uneMeteo -> idMeteo($iconMeteo);

    $Ajout = $uneMesure -> Ajouter_Mesure($temperature,$tempRessenti,$pression,$humidite,$vitesseVent,$directionVent,$rafaleVent,$nebulosite,$visibilite,$pluie,$pluie3h,$leveSoleil,$coucheSoleil,$DateMesure,$HeureMesure,$lieu['id_lieu'],$idMeteo['id_meteo']);

}
} catch (Exception $e) {

    echo 'Erreur enregistrement : '. $e -> getMessage(); 
}



