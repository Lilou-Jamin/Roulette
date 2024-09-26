<?php

require_once "$racine/config/connexion_sql.php";
include_once 'src/m/Eleve.php';
include_once 'src/m/Classe.php';

$eleve = new Eleve();
$classe = new Classe();

$listeEleves = $eleve->getEleves();
$listeClasses = $classe->getClasses();
$listeMoyennes = $eleve->getElevesMoyenne();

// Pour chaque classe on récupère les élèves correspondants
$listeElevesParClasse = [];
foreach ($listeClasses as $c) {
    $listeElevesParClasse[$c['id_classe']] = $eleve->getElevesParClasse($c['id_classe']);
}

include 'src/v/accueil_view.php';
