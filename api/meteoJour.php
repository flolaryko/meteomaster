<?php
require_once('Models/LieuModel.php');
require_once('Models/MesureModel.php'); // graphique
require_once('Models/MeteoModel.php');
$uneMesure = new MesureModel(); // graphique
$uneMeteo = new MeteoModel();
$unLieu = new LieuModel();



$Lieux = $unLieu -> All_Lieux();

try {
    $i = 0;

foreach ($Lieux as $lieu) {

    if ($i >= 3) { break;}   
    $url_api = 'https://api.openweathermap.org/data/2.5/onecall?lat=' . $lieu['latitude'] . '&lon=' . $lieu['longitude'] . '&appid=273b150084efde797ba71126e1898096&units=metric&lang=fr&exclude=minutely,hourly,daily';
    $json=file_get_contents($url_api);
    $tab=json_decode($json,true); 


    $temperature= $tab["current"]["temp"];
    $descriptionMeteo = $tab["current"]["weather"][0]["description"];
    $iconMeteo = $tab["current"]["weather"][0]["icon"];

    ?>
      <div class="col-lg-4">
        <div class="rond-lieu" > <img class="" src="assets/picture/<?php echo $iconMeteo; ?>.png"></div> 
       <strong><h2><?php echo $lieu['libelle_lieu']?></h2></strong> 
        <h3><p><?php echo $temperature?> ° C</p></h3>
       <h4> <p><?php echo ucfirst($descriptionMeteo)?></p></h4>
        <p><a class="btn btn-secondary" href="#">Détails »</a></p>
        </div> 
<?php 
        $i++;

}

} catch (Exception $e) {

    echo 'Erreur enregistrement : '. $e -> getMessage(); 
} ?>