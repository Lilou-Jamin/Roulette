<?php
require_once "$racine/config/connexion_sql.php";

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

    // Récupère les élèves par id_classe
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

    // Récupère les élèves avec le nom de leur section (SIO1, SIO2 etc...)
    public function getElevesParClasseSection($section) {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("select * from eleve join classe using(id_classe) where section like :section order by nom");
            $req->bindValue(':section', $section, PDO::PARAM_STR);
    
            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }
    
    // Sélectionne les élèves selon leur moyenne en ordre décroissant
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

    // Met l'attribut "passe" à 1
    public function updateElevePasse($id) {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("update eleve set passe=true where id like :id");   
            $req->bindValue(':id', $id, PDO::PARAM_INT);

            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Ajoute 1 au nb passages
    public function updateEleveNbPassages($id) {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("update eleve set nb_passages = nb_passages+1 where id like :id");   
            $req->bindValue(':id', $id, PDO::PARAM_INT);

            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Sélectionne l'attribut "passe" pour un élève donné
    public function getElevePasse($id) {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("select passe from eleve where id = :id");   
            $req->bindValue(':id', $id, PDO::PARAM_INT);

            $req->execute();
    
            $resultat = $req->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Sélectionne tous les élèves qui sont déjà passés
    public function getElevesPasses() {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("select * from eleve where passe=1");   

            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Réinitialise tous les passages des élèves qui sont déjà passés
    public function resetPassages() {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("update eleve set passe=false where passe=true");   

            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Réinitialise le nb passages de tous les élèves
    public function resetNbPassages() {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("update eleve set nb_passages=0");   

            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Réinitialise le nb notes de tous les élèves
    public function resetNbNotes() {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("update eleve set nb_notes=0");   

            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Réinitialise le total notes de tous les élèves
    public function resetTotalNotes() {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("update eleve set total_notes=0");   

            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Ajoute la note attribuée à un élève à son total de notes
    public function ajoutNote($id, $note) {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("update eleve set total_notes = total_notes+:note where id=:id");   
            $req->bindValue(':id', $id, PDO::PARAM_INT);
            $req->bindValue(':note', $note, PDO::PARAM_INT);

            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Ajoute 1 au nb notes
    public function incrementNbNote($id) {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("update eleve set nb_notes = nb_notes + 1 where id=:id");   
            $req->bindValue(':id', $id, PDO::PARAM_INT);

            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Met à jour l'attribut absent à 1 et passe à 0 quand un élève est absent
    public function updateEleveAbsent($id) {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("update eleve set absent=1 and passe=0 where id=:id");   
            $req->bindValue(':id', $id, PDO::PARAM_INT);

            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Réinitialise tous les élèves absents
    public function resetAbsent() {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("update eleve set absent=0");   

            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Met à jour la moyenne d'un élève
    public function updateEleveMoyenne($id) {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("update eleve set moyenne = total_notes/nb_notes where id=:id");   
            $req->bindValue(':id', $id, PDO::PARAM_INT);

            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Réinitialise la moyenne de tous les élèves
    public function resetMoyenne() {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("update eleve set moyenne = 0");   

            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }
}

