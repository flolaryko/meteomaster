<?php 

require_once('Database.php');

class MeteoModel extends Database {

    public function __construct() {
        parent::__construct();
    }

    public function All_Meteo () {
        

        
        $sqlQuery = 'SELECT * FROM meteo';
        $req = $this->db->prepare($sqlQuery);
        $req->execute();
        $data = $req->fetchAll();

        return $data;

    }

    public function MeteoJour ($libelleLieu) {

       
        $sqlQuery = 'SELECT meteo.description , temperature FROM lieu INNER JOIN mesure ON lieu.id_lieu = mesure.id_lieu 
        INNER JOIN meteo ON mesure.id_meteo = meteo.id_meteo WHERE date_mesure = DATE(NOW()) AND libelle_lieu= :lieu';
        $req = $this->db->prepare($sqlQuery);
        $req->execute(['lieu' => $libelleLieu]);
        $data = $req->fetch(PDO::FETCH_ASSOC);

        return $data;


    }
    
    
}