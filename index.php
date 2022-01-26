<?php 
require('Controllers/MeteoController.php');
require('Controllers/MesureController.php');
require('Controllers/LieuController.php');

if(isset($_GET["page"])){

    require('view/'.$_GET["page"].'.php');

}else{

    require('view/accueilView.php');
}

