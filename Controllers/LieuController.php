<?php
require('Models/LieuModel.php');


function Nomlieux() {

    $lieuModel = new LieuModel();
    $NomLieux = $lieuModel -> Lieux();
    
    return $NomLieux;
} 
$unLieu= new LieuModel();
$lieux= $unLieu->All_Lieux();