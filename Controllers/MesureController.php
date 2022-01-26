<?php

require ('__DIR__/../Models/MesureModel.php');

function topChaud($Lieu) {

    $MesureModel = new MesureModel();
    $Mesure = $MesureModel -> topChaud($Lieu);
    
    return $Mesure;
} 



