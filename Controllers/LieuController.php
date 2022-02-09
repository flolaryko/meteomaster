<?php
require('Models/LieuModel.php');

// récupérer le nom des lieux à afficher dans les vues
function Nomlieux() {

    $lieuModel = new LieuModel();
    $NomLieux = $lieuModel -> Lieux();
    
    return $NomLieux;
} 
$unLieu= new LieuModel();
$lieux= $unLieu->All_Lieux();