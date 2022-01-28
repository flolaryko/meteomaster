<?php $title = 'MétéoScan'; 

$Lieux = Nomlieux();


?>

<?php ob_start(); ?>
<?php require_once('navBarView.php')?>
<?php require_once('headerView.php');?>

<div class="container marketing">

  
  <div class="row">   
    <?php require('api/meteoJour.php');?>
  </div>
</div>



<div class="container py-4">
   <!-- bloc rectangle--> 
    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5" style="color: white;">
        <h1 class="display-5 fw-bold">Exemple de top</h1>
        <p class="col-md-8 fs-4" color: white>tDuplexque isdem diebus acciderat malum, quod et Theophilum insontem atrox interceperat casus, et Serenianus dignus exsecratione cunctorum, innoxius, modo non reclamante publico vigore, discessit.</p>
        <button class="btn btn-outline-light" type="button">Voir le graphique »</button>
      </div>
    </div>
<!-- bloc carré--> 
    <div class="row align-items-md-stretch">
      <div class="col-md-6">
        <div class="h-100 p-5 text-white bg-dark rounded-3" style="background-color: #003f89!important;">
          <h2>Exemple de top 2</h2>
          <p>Duplexque isdem diebus acciderat malum, quod et Theophilum insontem atrox interceperat casus, et Serenianus dignus exsecratione cunctorum, innoxius, modo non reclamante publico vigore, discessit.</p>
          <button class="btn btn-outline-light" type="button">Voir le graphique »</button>
        </div>
      </div>
<!-- bloc carre--> 
      <div class="col-md-6">
        <div class="h-100 p-5 bg-light border rounded-3">
          <h2>Exemple de top 3</h2>
          <p>Duplexque isdem diebus acciderat malum, quod et Theophilum insontem atrox interceperat casus, et Serenianus dignus exsecratione cunctorum, innoxius, modo non reclamante publico vigore, discessit.</p>
          <button class="btn btn-outline-secondary" type="button">Voir le graphique » </button>
        </div>
      </div>
    </div>

  </div>


<?php require_once('footerView.php');?>

<?php $content = ob_get_clean(); ?> <!-- tout le code enttre ob start et ob get clean sera dans $content-->

<?php require_once('template.php'); ?>
