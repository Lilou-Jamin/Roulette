<?php
require_once "$racine/config/connexion_sql.php";

class Eleve extends ConnexionPDO{
    public function getEleves() {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("select * from eleve order by nom_eleve");
            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Récupère les élèves par id_classe
    public function getElevesParClasse($id_classe) {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("select * from eleve join classe using(id_classe) where id_classe=:id_classe order by nom_eleve");
            $req->bindValue(':id_classe', $id_classe, PDO::PARAM_INT);
    
            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Récupère un élève par son ID
    public function getEleveParId($id_eleve){
        $resultat = [];

        try{
            $cnx = $this->connexion();
            $req = $cnx->prepare("select * from eleve join classe using(id_classe) where id_eleve=:id_eleve");
            $req->bindValue(':id_eleve', $id_eleve, PDO::PARAM_INT);

            $req->execute();

            $resultat = $req->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }
    
     // Récupère la moyenne d'un élève par son Id
     public function getEleveMoyenne($id_eleve) {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("select avg(note) as moyenne from passage where id_eleve=:id_eleve");   
            $req->bindValue(':id_eleve', $id_eleve, PDO::PARAM_INT);

            $req->execute();
    
            $resultat = $req->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Met l'attribut "passe" à 1
    public function updateElevePasse($id_eleve) {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("update eleve set passe=true where id_eleve=:id_eleve");   
            $req->bindValue(':id_eleve', $id_eleve, PDO::PARAM_INT);

            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Sélectionne l'attribut "passe" pour un élève donné
    public function getElevePasse($id_eleve) {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("select passe from eleve where id_eleve=:id_eleve");   
            $req->bindValue(':id_eleve', $id_eleve, PDO::PARAM_INT);

            $req->execute();
    
            $resultat = $req->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Sélectionne tous les élèves qui sont déjà passés
    // A REVOIR
    public function getElevesPasses($id_classe) {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("
                SELECT e.id_eleve, e.nom_eleve, e.prenom_eleve, 
                       COALESCE(p.note, 'Absent') AS note
                FROM eleve e
                LEFT JOIN passage p ON e.id_eleve = p.id_eleve
                WHERE e.passe = 1 AND e.id_classe = :id_classe
                ORDER BY e.nom_eleve
            ");
            $req->bindValue(':id_classe', $id_classe, PDO::PARAM_INT);
            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Met à jour l'attribut absent à 1 et passe à 0 quand un élève est absent
    public function updateEleveAbsent($id_eleve) {
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("update eleve set absent=true, passe=true where id_eleve=:id_eleve");   
            $req->bindValue(':id_eleve', $id_eleve, PDO::PARAM_INT);

            $req->execute();

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    public function resetElevesPassage($id_classe){
        $resultat = [];

        try{
            $cnx = $this->connexion();
            $req = $cnx->prepare("update eleve set passe=false where id_classe=:id_classe; update eleve set absent=false where id_classe = :id_classe; ");
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

