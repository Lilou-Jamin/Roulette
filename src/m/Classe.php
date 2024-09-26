<?php
require_once "$racine/config/connexion_sql.php";

class Classe extends ConnexionPDO{
    // Sélectionne toutes les classes (pour avoir leur nom par ex)
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