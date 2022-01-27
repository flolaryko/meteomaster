<?php
require('Models/LieuModel.php');


function Nomlieux() {

    $lieuModel = new LieuModel();
    $NomLieux = $lieuModel -> Lieux();
    
    return $NomLieux;
} 
