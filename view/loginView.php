<?php
$erreur = null;
$login = "admin";
$mdp = hash("sha256", 1234);

if (isset($_POST['login'], $_POST['password'])) {

    if (($_POST['login'] === $login) && (hash("sha256",$_POST['password']) === $mdp))
    {
        $_SESSION['login'] = $_POST['login'];
        header('Location: index.php');
    } else {
        $erreur = "identifiants incorrects";
    }

}
?>

    <?php if($erreur): ?>
    <div class="alert alert danger"><?php echo $erreur ?></div>
    <?php endif; ?>

<?php $title = 'Connexion'; ?>
<?php ob_start(); 
require_once('navBarView.php');?>
<br>

<form method="post" action=""
    style="margin: 0 auto;
    width: 300px;">

   <h1 class="h3 mb-3 fw-normal">Connexion admin</h1>

   <div class="form-floating">
     <input type="text" name="login" class="form-control" id="floatingInput" placeholder="identifiant">
     <label for="floatingInput">Identifiant </label>
   </div>

   <div class="form-floating">
     <input type="text" name="password" class="form-control" id="floatingPassword" placeholder="Mot de passe">
     <label for="floatingPassword">Mot de passe</label>
   </div>

   <div class="form-floating">
   <button class="w-100 btn btn-lg btn-primary" type="submit">Connexion</button>
   </div>

</form>
<br>
<?php $content = ob_get_clean(); 
require_once('template.php');
require_once('footerView.php');
?> 
