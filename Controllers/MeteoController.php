<?php

require_once('__DIR__/../Models/MeteoModel.php');


function MeteoJour($Lieu) {

    $MeteoModel = new \MeteoModel();
    $MeteoJour = $MeteoModel -> MeteoJour($Lieu);
     
    return $MeteoJour;
    }



 