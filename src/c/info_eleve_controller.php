<?php
require_once "$racine/config/connexion_sql.php";
include_once 'src/m/Eleve.php';
include_once 'src/m/Classe.php';
include_once 'src/m/Passage.php';

$passage = new Passage();
$eleve = new Eleve();

// On récupère l'id de l'élève concerné via l'url
$id_eleve_info = $_GET['id_eleve'];

// On récupère les infos de l'élève
$eleve_info = $eleve->getEleveParId($id_eleve_info);
$eleve_moyenne = $eleve->getEleveMoyenne($id_eleve_info);
$eleve_passages = $passage->getPassageParIdEleve($id_eleve_info);

include 'src/v/base_view.php';
include 'src/v/info_eleve_view.php';
