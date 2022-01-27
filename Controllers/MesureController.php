<?php

require ('__DIR__/../Models/MesureModel.php');

function topChaud($Lieu) {

    $MesureModel = new meteoscan\MesureModel();
    $Mesure = $MesureModel -> topChaud($Lieu);
    
    return $Mesure;
} 



