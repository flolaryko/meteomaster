<?php 

require_once('Database.php');

class MesureModel extends Database {

    public function __construct() {
        parent::__construct();
    }

    public function All_Mesure () {

       
        $sqlQuery = 'SELECT * FROM mesure';
        $req = $this->db->prepare($sqlQuery);
        $req->execute();
        $data = $req->fetchAll();

        return $data;

    }

    public function Une_Mesure ($libelleLieu,$date_mesure) {

      
        $sqlQuery = 'SELECT * FROM mesure JOIN lieu ON mesure.id_lieu = lieu.id_lieu WHERE libelle_lieu = :lieu AND date_mesure = :date_mesure';
        $req =$this->db->prepare($sqlQuery);
        $req->execute(['lieu' => $libelleLieu, 'date_mesure'=> $date_mesure]);
        $data = $req->fetch(\PDO::FETCH_ASSOC);

        return $data;

    }

    public function Ajouter_Mesure ($temp, $temp_ressentie, $pression, $humidite, $vit_vent, $dir_vent, $rafale_vent, $nebulosite,$visibilite, $pluie_h, $pluie_3h, $leve_sol, $couche_sol, $date_mesure, $heure_mesure, $id_lieu, $id_meteo) {

       
        $sqlQuery = 'INSERT INTO mesure(temperature, temperature_res, pression, humidite, vitesse_vent, direction_vent, rafale_vent, nebulosite, visibilite, pluie_h, pluie_3h, leve_soleil, couche_soleil, date_mesure, heure_mesure, id_lieu, id_meteo) 
                     VALUES            (:temperature, :temperature_res, :pression, :humidite, :vitesse_vent, :direction_vent, :rafale_vent, :nebulosite, :visibilite, :pluie_h, :pluie_3h, :leve_soleil, :couche_soleil, :date_mesure, :heure, :id_lieu, :id_meteo)';
        
        $req = $this->db->prepare($sqlQuery);

        $req->execute([
            'temperature' => $temp,
            'temperature_res' => $temp_ressentie,
            'pression' => $pression,
            'humidite' => $humidite,  
            'vitesse_vent' => $vit_vent,
            'direction_vent' => $dir_vent,
            'rafale_vent' => $rafale_vent,
            'nebulosite' => $nebulosite,
            'visibilite' => $visibilite,
            'pluie_h' => $pluie_h,
            'pluie_3h' => $pluie_3h,
            'leve_soleil' => $leve_sol,
            'couche_soleil' => $couche_sol,
            'date_mesure' => $date_mesure,
            'heure' => $heure_mesure,
            'id_lieu' => $id_lieu,
            'id_meteo' => $id_meteo,       
        ]);

        return $req;

    }

    public function Select_Elements(array $champs) {

        $data = [];

        foreach ($champs as $champ) {

          
            $sqlQuery = 'SELECT '.$champ.' FROM mesure';
            $req = $this->db->prepare($sqlQuery);
            $req->execute();
            $data[] = $req->fetchAll();
    
        }

        return $data;

    }

    public function topChaud ($libelleLieu) {

      
        $sqlQuery = 'SELECT max(temperature) AS maxtemp, date_mesure FROM mesure INNER JOIN lieu ON mesure.id_lieu = lieu.id_lieu WHERE libelle_lieu = :lieu GROUP BY date_mesure';
        $req = $this->db->prepare($sqlQuery);
        $req->execute(['lieu' => $libelleLieu]);
        $data = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $data;

    }

    public function statSemaine ($date_choisie,$date_ancienne,$lieu) {

          
        $sqlQuery = 'SELECT temperature, pluie_h, vitesse_vent, visibilite, date_mesure FROM mesure INNER JOIN lieu ON mesure.id_lieu = lieu.id_lieu WHERE libelle_lieu = :lieu AND date_mesure BETWEEN :date_ancienne AND :date_choisie ORDER BY date_mesure';
        $req = $this->db->prepare($sqlQuery);
        $req->execute(['lieu' => $lieu, 'date_ancienne' => $date_ancienne, 'date_choisie' => $date_choisie]);
        $data = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $data;

    }

    
    
    
}