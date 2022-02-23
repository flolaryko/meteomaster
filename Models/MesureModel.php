<?php 

require_once('Database.php');

class MesureModel extends Database {

    public function __construct() {
        parent::__construct();
    }

   
    public function All_Nom_Mesure () {

       
        $sqlQuery = "SHOW COLUMNS FROM mesure WHERE Field not in ('id_mesure','id_meteo','id_lieu') ";
        $req = $this->db->prepare($sqlQuery);
        $req->execute();
        $data = $req->fetchAll(\PDO::FETCH_ASSOC);
        
        return $data;

    }


    public function Une_Mesure ($libelleLieu,$date_mesure) {

      
        $sqlQuery = 'SELECT * FROM mesure JOIN lieu ON mesure.id_lieu = lieu.id_lieu WHERE libelle_lieu = :lieu AND date_mesure = :date_mesure';
        $req =$this->db->prepare($sqlQuery);
        $req->execute(['lieu' => $libelleLieu, 'date_mesure'=> $date_mesure]);
        $data = $req->fetch(\PDO::FETCH_ASSOC);

        return $data;

    }
 public function All_Mesure () {

       
        $sqlQuery = 'SELECT * FROM mesure';
        $req = $this->db->prepare($sqlQuery);
        $req->execute();
        $data = $req->fetchAll();

        return $data;

    }
    public function Une_Mesure_Comp ($libelleLieu,$dateDebut, $dateFin,$mesure) {

      
        $sqlQuery = 'SELECT '.$mesure.' AS mesure, date_mesure, heure_mesure FROM mesure INNER JOIN lieu ON mesure.id_lieu = lieu.id_lieu WHERE libelle_lieu = :lieu AND date_mesure BETWEEN :dateDebut AND :dateFin  ORDER BY date_mesure, heure_mesure';
        $req =$this->db->prepare($sqlQuery);
        $req->execute(['lieu' => $libelleLieu,
                        'dateDebut'=>$dateDebut,
                         'dateFin'=>$dateFin,
                          ]);
        $data = $req->fetchAll(\PDO::FETCH_ASSOC);

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

    public function topChaudSemaine () {

        $date = date('Y-m-d');
        $date7 = date('Y-m-d', strtotime($date. ' - 7 days'));

        $sqlQuery = 'SELECT max(temperature) AS maxtemp, date_mesure, libelle_lieu FROM mesure INNER JOIN lieu ON mesure.id_lieu = lieu.id_lieu WHERE date_mesure BETWEEN :date7 AND :date_jour GROUP BY date_mesure,libelle_lieu';
        $req = $this->db->prepare($sqlQuery);
        $req->execute(['date_jour' => $date, 'date7' => $date7]);
        $data = $req->fetchAll(\PDO::FETCH_ASSOC);
        $hot = ['maxtemp' => -100, 'lieu' => '', 'jour' => ''];

        foreach ($data as $dat) {

            if ($dat['maxtemp'] > $hot['maxtemp']) {
                $hot['maxtemp'] = $dat['maxtemp'];
                $hot['lieu'] = $dat['libelle_lieu'];
                $hot['jour'] = $dat['date_mesure'];
            }
        }

        return $hot;

    }

    public function statDuree ($date_choisie,$date_ancienne,$lieu) {

          
        $sqlQuery = 'SELECT temperature, pluie_h, vitesse_vent, visibilite, date_mesure FROM mesure INNER JOIN lieu ON mesure.id_lieu = lieu.id_lieu WHERE libelle_lieu = :lieu AND date_mesure BETWEEN :date_ancienne AND :date_choisie ORDER BY date_mesure';
        $req = $this->db->prepare($sqlQuery);
        $req->execute(['lieu' => $lieu, 'date_ancienne' => $date_ancienne, 'date_choisie' => $date_choisie]);
        $data = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $data;

    }

    public function topFroidSemaine () {

        $date = date('Y-m-d');
        $date7 = date('Y-m-d', strtotime($date. ' - 7 days'));

        $sqlQuery = 'SELECT min(temperature) AS mintemp, date_mesure, libelle_lieu FROM mesure INNER JOIN lieu ON mesure.id_lieu = lieu.id_lieu WHERE date_mesure BETWEEN :date7 AND :date_jour GROUP BY date_mesure,libelle_lieu';
        $req = $this->db->prepare($sqlQuery);
        $req->execute(['date_jour' => $date, 'date7' => $date7]);
        $data = $req->fetchAll(\PDO::FETCH_ASSOC);
        $cold = ['mintemp' => 100, 'lieu' => '', 'jour' => ''];

        foreach ($data as $dat) {

            if ($dat['mintemp'] < $cold['mintemp']) {
                $cold['mintemp'] = $dat['mintemp'];
                $cold['lieu'] = $dat['libelle_lieu'];
                $cold['jour'] = $dat['date_mesure'];

            }
        }

        return $cold;

    }

    public function dateComplete (string $datedujour ) {

       if ($datedujour == "" ) {
           return $dateC = "Aucune donnée pour cette période";
       } else {

        $jour = ["Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi"];
        $mois = ["","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"];
        
        $dateC = $jour[date('w', strtotime($datedujour))]." ".date('d', strtotime($datedujour))." ".$mois[date('n', strtotime($datedujour))]." ".date('Y', strtotime($datedujour));
    
        return $dateC;

       }

    }

    
    
    
}