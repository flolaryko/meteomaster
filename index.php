<?php 
session_start();
if (isset($_GET["etat"]) && ($_GET['etat'] == 0)) {
unset($_SESSION['login']);
header('Location: index.php');
}
if (isset($_GET["page"]) && ($_GET['page'] == "ajouLieuView")) {
if ($_SESSION['login'] != "admin") {
    header('Location: index.php?p=Veuillez+vous+connecter');
}
}

require('Controllers/MeteoController.php');
require('Controllers/MesureController.php');
require('Controllers/LieuController.php');

if(isset($_GET["page"])){

    require('view/'.$_GET["page"].'.php');

}else{

    require('view/accueilView.php');
}

