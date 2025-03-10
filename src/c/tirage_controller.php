<?php
require_once "$racine/config/connexion_sql.php";
include_once 'src/m/Eleve.php';
include_once 'src/m/Classe.php';
include_once 'src/m/Passage.php';

$eleve = new Eleve();
$passage = new Passage();

$listeElevesParClasse = $eleve->getElevesParClasse($_SESSION['select_classe']);
$elevesattente = [];
$elevespasses = [];

    // PARTIE TIRAGE
    foreach($listeElevesParClasse as $e){  
        if($eleve->getElevePasse($e["id_eleve"])["passe"] == false){ // Pour tous les élèves de la classe, on vérifie si il n'est pas encore passé
            $elevesattente[] = $e; // Et on l'ajoute à la liste d'attente
        }
    }


    if (isset($_POST['tirer'])){ // Si on effectue un tirage
        if(!empty($elevesattente)){ // Et que la liste d'attente n'est pas vide 
            $elevetireindex = array_rand($elevesattente, 1); // On assigne l'index de l'élève passé à une variable
            $elevetire = $elevesattente[$elevetireindex]; // On sélectionne dans la liste d'attente l'élève tiré avec son index
            
            $_SESSION['elevetire'] = $elevetire; // On met elevetire en variable globale pour pouvoir l'utiliser dans la notation
            array_splice($elevesattente, $elevetireindex, 1); // On le retire de la liste d'attente
        }
    }

    // PARTIE NOTATION
    if(isset($_POST['noter'])){
        $elevetire = $_SESSION['elevetire'];
        $note = $_POST['note']; // On récupère la note envoyée
        $passage->addPassage($elevetire['id_eleve'], $note);
        $eleve->updateElevePasse($elevetire['id_eleve']); // On met à jour l'attribut "passé" dans la BDD avec l'id de l'élève tiré
    
        // On remet l'élève séléctionné à vide pour le prochain
        if(isset($_SESSION["elevetire"])){
            $elevetire = null;
        }
        header("Location: http://localhost/Roulette/?action=tirage");
        exit();
    }

    // Si l'élève est absent :
    if(isset($_POST['mettre_absent'])){
        $elevetire = $_SESSION['elevetire'];
        $eleve->updateEleveAbsent($elevetire['id_eleve']); // On marque l'élève comme absent
        
        // On remet l'élève séléctionné à vide pour le prochain
        if(isset($_SESSION["elevetire"])){
            $elevetire = null;
        }
        header("Location: http://localhost/Roulette/?action=tirage");
        exit();
    }
    
    // Affichage de la liste des élèves déjà passés
    $elevespasses = $eleve->getElevesPasses($_SESSION['select_classe']); // On va chercher tous les étudiants passés

    // Appel bouton reset_passages de tous les élèves
    if (isset($_POST['reset_passages'])){ 
        $eleve->resetElevesPassage($_SESSION['select_classe']);
        $elevespasses = [];

        header("Location: http://localhost/Roulette/?action=tirage");
        exit();
    }

    // Appel bouton reset_notes de tous les élèves
    if (isset($_POST['reset_notes'])){ 
        $eleve->resetElevesPassage($_SESSION['select_classe']);
        $passage->resetPassages($_SESSION['select_classe']);
        $elevespasses = [];

        header("Location: http://localhost/Roulette/?action=tirage");
        exit();
    }

include 'src/v/base_view.php';
include 'src/v/tirage_view.php';