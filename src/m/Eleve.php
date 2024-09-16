<?php
require_once "bdd.php";

class Eleve extends ConnexionPDO{
    public function getEleves() {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("select * from eleve order by nom");
            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    
    public function getElevesParClasse($id_classe) {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("select * from eleve join classe using(id_classe) where id_classe like :id_classe order by nom");
            $req->bindValue(':id_classe', $id_classe, PDO::PARAM_INT);
    
            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }
    
    public function getElevesMoyenne() {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("select moyenne from eleve order by moyenne desc");   
            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }
}