<?php
include_once 'src/m/bdd.php';
include_once 'src/m/Eleve.php';
include_once 'src/m/Classe.php';

$eleve = new Eleve();
$listeElevesParClasseSection = $eleve->getElevesParClasseSection($_SESSION['select_classe']);
$elevesattente = [];
$elevespasses = [];

    // PARTIE TIRAGE
    foreach($listeElevesParClasseSection as $e){  
        if($eleve->getElevePasse($e["id"])["passe"] == 0){ // Pour tous les élèves de la classe, on vérifie si il n'est pas encore passé
            $elevesattente[] = $e; // Et on l'ajoute à la liste d'attente
        }
    }

    if (isset($_POST['tirer'])){ // Si on effectue un tirage
        if(!empty($elevesattente)){ // Et que la liste d'attente n'est pas vide 
            $elevetireindex = array_rand($elevesattente, 1); // On assigne l'index de l'élève passé à une variable
            $elevetire = $elevesattente[$elevetireindex]; // On sélectionne dans la liste d'attente l'élève tiré avec son index
            
            $_SESSION['elevetire']=$elevetire; // On met elevetire en variable globale pour pouvoir l'utiliser dans la notation
            array_splice($elevesattente, $elevetireindex, 1); // On le retire de la liste d'attente
        }
    }

    // PARTIE NOTATION
    if(isset($_POST['noter'])){
        $elevetire = $_SESSION['elevetire'];
        $note = $_POST['note']; // On récupère la note envoyée
        $eleve->ajoutNote($elevetire['id'],$note);
        $eleve->incrementNbNote($elevetire['id']);
        $eleve->updateEleveMoyenne($elevetire["id"]);
        $eleve->updateEleveNbPassages($elevetire["id"]);
        $eleve->updateElevePasse($elevetire['id']); // On met à jour l'attribut "passé" dans la BDD avec l'id de l'élève tiré
    }

    // Si l'élève est absent :
    if(isset($_POST['mettre_absent'])){
        $elevetire = $_SESSION['elevetire'];
        $eleve->updateEleveAbsent($elevetire['id']); // On met son "attribut" absent à 1     
    }
    
    // Affichage de la liste des élèves déjà passés
    $elevespasses = $eleve->getElevesPasses(); // On va chercher tous les étudiants passés

    // Appel bouton reset_passages
    if (isset($_POST['reset_passages'])){ 
        $eleve->resetPassages();
        $eleve->resetNbPassages();
        $eleve->resetAbsent();  
    }

    // Appel bouton reset_notes
    if (isset($_POST['reset_notes'])){ 
        $eleve->resetNbNotes();
        $eleve->resetTotalNotes();
        $eleve->resetMoyenne();
    }

//var_dump($elevesattente);
include 'src/v/base_view.php';
include 'src/v/tirage_view.php';