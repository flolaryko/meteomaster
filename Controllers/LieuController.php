<?php
require('Models/LieuModel.php');


function Nomlieux() {

    $lieuModel = new meteoscan\LieuModel();
    $NomLieux = $lieuModel -> Lieux();
    
    return $NomLieux;
} 
