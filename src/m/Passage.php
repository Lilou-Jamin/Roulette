<?php
require_once "$racine/config/connexion_sql.php";

class Passage extends ConnexionPDO{
    // Sélectionne un passage par son Id
    public function getPassageParId($id_passage) {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("select * passage where id_passage=:id_passage");
            $req->bindValue(':id_passage', $id_passage, PDO::PARAM_INT);

            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Ajoute un passage avec l'id_eleve et sa note
    public function addPassage($id_eleve, $note) {
        $resultat = [];

        $date_passage = date("Y-m-d H:i:s");

        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("insert into passage(id_eleve, date_passage, note) values (:id_eleve, :date_passage, :note)");
            $req->bindValue(':id_eleve', $id_eleve, PDO::PARAM_INT);
            $req->bindValue(':date_passage', $date_passage, PDO::PARAM_STR);
            $req->bindValue(':note', $note, PDO::PARAM_INT);

            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Récupère tous les passages d'un élève par son Id
    public function getPassageParIdEleve($id_eleve) {
        $resultat = [];

        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("select * from passage where id_eleve=:id_eleve");
            $req->bindValue(':id_eleve', $id_eleve, PDO::PARAM_INT);

            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Récupère toutes les notes d'un élève par son Id
    public function getNotesByIdEleve($id_eleve) {
        $resultat = [];

        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("select note from passage where id_eleve=:id_eleve");
            $req->bindValue(':id_eleve', $id_eleve, PDO::PARAM_INT);

            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    /* A REVOIR */
    public function resetPassages($id_classe) {
        $resultat = [];

        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("delete from passage where id_eleve in (select eleve.id_eleve from eleve where eleve.id_classe=:id_classe)");
            $req->bindValue(':id_classe', $id_classe, PDO::PARAM_INT);

            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }
}