<?php


require_once('Database.php');


class LieuModel extends Database {

    public function __construct() {
        parent::__construct();
    }


    public function All_Lieux () {

       
        $sqlQuery = 'SELECT * FROM lieu';
        $req = $this->db->prepare($sqlQuery);
        $req->execute();
        $data = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $data;

    }

    public function Ajouter_Lieu ($libelle_lieu, $longitude, $latitude) {


        $sqlQuery = 'INSERT INTO lieu(libelle_lieu, longitude, latitude) VALUES (:libelle_lieu, :longitude, :latitude)';

        $req = $this->db->prepare($sqlQuery);

        $req->execute([
            'libelle_lieu' => $libelle_lieu,
            'longitude' => $longitude,
            'latitude' => $latitude,
        ]);

        return $req;


    }

    public function Supprimer_Lieu ($id = NULL, $libelle = NULL) {

       
        if (isset($id)) {
            $sql = 'DELETE FROM lieu WHERE id_lieu = :id';
            $req = $this->db->prepare($sql);
            $req -> execute([ 'id' => $id]);
        } elseif (isset($libelle)) {
            $sql = 'DELETE FROM lieu WHERE libelle_lieu = :libelle';
            $req = $this->db->prepare($sql);
            $req -> execute([ 'libelle' => $libelle]);
        } else {
            return 'Erreur : Entrer au moins un paramètre';
        }

        return $req;

    }

    public function Lieux () {

       
        $sqlQuery = 'SELECT libelle_lieu FROM lieu';
        $req = $this->db->prepare($sqlQuery);
        $req->execute();
        $data = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $data;

    }

    public function idLieu($longitude, $latitude) {

       
        $sqlQuery = 'SELECT id_lieu FROM lieu  WHERE longitude = :lon AND latitude = :lat';

        $req = $this->db->prepare($sqlQuery);
        $req->execute(['lon' => $longitude, 'lat' => $latitude]);
        $data = $req->fetch(\PDO::FETCH_ASSOC);

        return $data;


    }

    

    

    

    
}