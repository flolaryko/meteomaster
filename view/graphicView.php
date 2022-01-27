


<?php
require_once('Models/MesureModel.php'); 
require_once("Models/LieuModel.php");

$unLieu= new LieuModel();
$uneMesure = new MesureModel();  

$lieux= $unLieu->All_Lieux(); // liste lieu select 

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



<div id="chartdiv"></div>



<?php require_once('footerView.php');?>

<?php $content = ob_get_clean(); ?> <!-- tout le code enttre ob start et ob get clean sera dans $content-->

<?php require_once('template.php'); ?>