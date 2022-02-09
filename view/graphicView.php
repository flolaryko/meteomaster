<?php
require_once('Models/MesureModel.php'); 
require_once("Models/LieuModel.php");
require_once("Controllers/LieuController.php");
require_once("Controllers/MesureController.php");



if(isset($_POST['lieu'],$_POST['date'])): //controle des champ vide
$data = $uneMesure -> Une_Mesure($_POST['lieu'],$_POST['date']);?>
<script>var dataRecu = <?php echo json_encode($data)?> </script>
<?php endif?>


<?php $title = 'Détail graphique'; ?>
<?php ob_start(); ?>
<?php require_once('navBarView.php')?>

<form method="post" action="index.php?page=graphicView" style="margin: 0 auto; width: 300px;">

    <h1 class="h3 mb-3 fw-normal" style="text-align: center;">Rechercher</h1>
    <label for="floatingInput">Choisir un lieu </label>
<div class="form-floating">
    <select name="lieu" class="form-control">
       <?php foreach ($lieux as $lieu):  ?>  
          <option value="<?php echo $lieu['libelle_lieu']?>"><?php echo $lieu['libelle_lieu']?></option>
       <?php endforeach ?>
    </select>
</div>

    <div class="form-floating">
      <input class="form-control" type="date" name="date" value="2022-01-26">
    </div>
   <br>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Rechercher</button>
</form>


<div class="main" style="margin-top:50px; ">
         
          <div class="block-wrapper">
              <div class="block">
                  <p><span><ion-icon size="large" name="thermometer-outline"></ion-icon></span></p>
                  <p class="counter-wrapper"><span class="temp"></span> C°</p>
                  <p class="text-block">Température</p>
              </div>
              <div class="block">
                <p><span><ion-icon size="large" name="thermometer-outline"></ion-icon></span></p>
                <p class="counter-wrapper"><span class="tempR"></span> C°</p>
                <p class="text-block">Température ressenti</p>
              </div>
             <div class="block">
                  <p><span><ion-icon size="large"name="repeat-outline"></ion-icon></span></p>
                  <p class="counter-wrapper"><span class="vit"></span> Km/h</p>
                  <p class="text-block">Vitesse du vent</p>
              </div>
              <div class="block">
                <p><span><ion-icon size="large" name="shuffle-outline"></ion-icon></span></p>
                <p class="counter-wrapper"><span class="raf"></span> Km/h</p>
                <p class="text-block">Rafale de vent</p>
            </div>
              <div class="block">
                  <p><span><ion-icon size="large" name="water-outline"></ion-icon></span></p>
                  <p class="counter-wrapper"><span class="humi"></span> %</p>
                  <p class="text-block">Humidité</p>
              </div>
             
            <div class="block">
                <p><span><ion-icon name="rainy-outline" size="large"></ion-icon></span></p>
                <p class="counter-wrapper"><span class="plui"></span> Mm/h</p>
                <p class="text-block">Pluie</p>
            </div>
            <div class="block">
                <p><span><ion-icon size="large" name="cloudy-outline"></ion-icon></span></p>
                <p class="counter-wrapper"><span class="nebu"></span> Octa</p>
                <p class="text-block">Nébulosité</p>
            </div>
            <div class="block">
                <p><span><ion-icon name="barbell-outline" size="large"></ion-icon></span></p>
                <p class="counter-wrapper"><span class="press"></span> hPa</p>
                <p class="text-block">Pression</p>
            </div>
             <div class="block">
                <p><span><ion-icon name="eye-outline" size="large"></ion-icon></span></p>
                <p class="counter-wrapper"><span class="visi"></span> M</p>
                <p class="text-block">Visibilité</p>
            </div>
            </div>
      </div>

     



    <script src="assets/js/jquery-1.12.4.min.js"></script>
    <script src="assets/js/animationCounter.js" charset="utf-8"></script>
    <script type="text/javascript">
    $('#counter-block').ready(function(){
        $('.temp').animationCounter({
          start:0,
          step: 1,
          end:parseFloat(dataRecu['temperature']),
          delay:50
          
        });
        $('.tempR').animationCounter({
          start: 0,
          end:parseFloat(dataRecu['temperature_res']),
          step: 1,
          delay:50
          
        });
        $('.humi').animationCounter({
          start: 0,
          end: parseFloat(dataRecu['humidite']),
          step: 2,
          delay: 50
        });
        $('.vit').animationCounter({
          start: 0,
         end: parseFloat(dataRecu['vitesse_vent'])*3.6,
          step: 1,
          delay: 50,
          
        });
        $('.raf').animationCounter({
          start: 0,
         end:parseFloat(dataRecu['rafale_vent'])*3.6,
          step: 1,
          delay: 50,
         
        });
        $('.plui').animationCounter({
          start: 0,
         end:parseFloat(dataRecu['pluie_h']),
          step: 1,
          delay: 50,
       
        });
        $('.nebu').animationCounter({
          start: 0,
          end: parseFloat(dataRecu['nebulosite']),
          step: 1,
          delay: 50,
         
        });
        $('.press').animationCounter({
          start:0,
         end:parseFloat(dataRecu['pression']),
          step: 10,
          delay: 10,
         
        });
        $('.visi').animationCounter({
          start: 0,
          end: parseFloat(dataRecu['visibilite']),
          step: 50,
          delay: 10,
         
        });
    });
    </script>
    <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>


      



<?php require_once('footerView.php');?>

<?php $content = ob_get_clean(); ?> 

<?php require_once('template.php'); ?>