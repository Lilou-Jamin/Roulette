<?php
require_once "bdd.php";

class Classe extends ConnexionPDO{
    public function getClasses() {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("select * from classe");
            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }
}