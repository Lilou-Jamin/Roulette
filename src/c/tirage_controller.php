<?php
include_once 'src/m/bdd.php';
include_once 'src/m/eleve.php';
include_once 'src/m/classe.php';


$eleve = new Eleve();
$listeElevesParClasseSection = $eleve->getElevesParClasseSection($_SESSION['select_classe']);

$elevesattente = $listeElevesParClasseSection;
$elevespasses = [];

    if (isset($_POST['tirer'])){
    
        $elevetireindex = array_rand($elevesattente, 1); // On assigne l'index de l'élève passé à une variable
        $elevetire = $elevesattente[$elevetireindex]; // On sélectionne dans la liste d'attente l'élève tiré avec son index
        
        
        $eleve->updateElevePasse($elevetire['id']); // On met à jour l'attribut "passé" dans la BDD avec l'id de l'élève tiré
        array_splice($elevesattente, $elevetireindex, 1); // On le retire de la liste d'attente
        echo $elevetireindex;
    }

var_dump($elevesattente);
include 'src/v/base_view.php';
include 'src/v/tirage_view.php';