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

    public function updateEleveAbsent($id) {
        $resultat = [];
    
        try {
            $cnx = $this->connexion();
            $req = $cnx->prepare("update eleve set absent=true where id=:id");   
            $req->bindValue(':id', $id, PDO::PARAM_INT);

            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

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
}

