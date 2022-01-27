<?php
namespace meteoscan;
class Database {

    const DNS = 'localhost';
    const NAME = 'meteoscan';
    const LOGIN = 'root';
    const PASSWORD = '';

    protected $db; 

    public function __construct()
    {
        try {
            $this->db = new \PDO('mysql:host=' . Database::DNS . ';dbname='. Database::NAME. ';charset=utf8', Database::LOGIN , Database::PASSWORD, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
           
        }
        catch (\Exception $e){

            die('Erreur : '.$e->getMessage());

        }
    } 

}