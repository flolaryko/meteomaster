<?php
//recup du json de lapi
$json=file_get_contents('https://api.openweathermap.org/data/2.5/onecall?lat=43.29539558730914&lon=5.374606059952244&appid=273b150084efde797ba71126e1898096&units=metric&lang=fr&exclude=minutely,hourly,daily');
// decocade du json en tableau 
$tab=json_decode($json,true); 
// die(var_dump($tab["current"]["weather"][0]["description"]));


// transformation du tableau en variable separé avec leur clef associatif en nom de variable 
$tabExtract=extract($tab);


$latitude=$tab["lat"];
$longitude=$tab["lon"];
$fuseau=$tab["timezone"];
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
$vitesseVent=$tab["current"]["wind_speed"]; // en m/s
$directionVent=$tab["current"]["wind_deg"]; // en °
$rafaleVent=$tab["current"]["wind_gust"]; // en m/s
$idMeteo = $tab["current"]["weather"][0]["id"]; // faire un insert des 4 paramètres dans la table méteo chaque jour et dans la clé étrangère id_meteo de mesure
$libelleMeteo = $tab["current"]["weather"][0]["main"];
$descriptionMeteo = $tab["current"]["weather"][0]["description"];
$iconMeteo = $tab["current"]["weather"][0]["icon"];

// manque pluie_h et pluie_3h en mm et voir problème de l'id_meteo qui correspond pas




