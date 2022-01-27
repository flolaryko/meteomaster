


<?php
require_once('Models/MesureModel.php'); 

$uneMesure = new MesureModel();  

$data = $uneMesure -> Une_Mesure($_POST['lieu'],date('Y-m-d')); 



?>
<?php $title = 'Détail graphique'; ?>
<?php ob_start(); ?>
<?php require_once('navBarView.php')?>

<form method="post" action="graphicView.php" style="margin: 0 auto; width: 300px;">

    <h1 class="h3 mb-3 fw-normal" style="text-align: center;">Rechercher</h1>
    <div class="form-floating">
      <input type="text" name="lieu" class="form-control" id="floatingInput" placeholder="La ciotat">
      <label for="floatingInput">Nom du lieu </label>
    </div>

    <div class="form-floating">
      <input type="date" name="date" value="2021-07-22">
    </div>
   <br>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Rechercher</button>
</form>

<div id="chartdiv"></div>



<?php require_once('footerView.php');?>

<?php $content = ob_get_clean(); ?> <!-- tout le code enttre ob start et ob get clean sera dans $content-->

<?php require_once('template.php'); ?>