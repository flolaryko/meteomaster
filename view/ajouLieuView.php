<?php 


?>

<?php $title = 'Enregistrer lieu'; ?>
<?php ob_start(); ?>
<?php require_once('navBarView.php')?>;

<form method="post" action="ajouLieuView.php"
 style="margin: 0 auto;
     width: 300px;">

   <img class="mb-4" src="assets/picture/point.png" alt="" width="90" height="50">
    <h1 class="h3 mb-3 fw-normal">Enregistrer un lieu</h1>

    <div class="form-floating">
      <input type="text" name="libelle_lieu" class="form-control" id="floatingInput" placeholder="La ciotat">
      <label for="floatingInput">Nom du lieu </label>
    </div>

    <div class="form-floating">
      <input type="text" name="longitude" class="form-control" id="floatingPassword" placeholder="5.6548">
      <label for="floatingPassword">Longitude</label>
    </div>

	<div class="form-floating">
      <input type="text" name="latitude" class="form-control" id="floatingPassword" placeholder="6.8965">
      <label for="floatingPassword">Latitude</label>
    </div>
   <br>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Enregitrer</button>
   
</form>
 </div>
 <br>

<?php require_once("footerView.php")?>

<?php $content = ob_get_clean(); ?> <!-- tout le code enttre ob start et ob get clean sera dans $content-->

<?php require_once('template.php'); ?>

