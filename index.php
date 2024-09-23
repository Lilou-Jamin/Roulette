<?php

session_start();
require_once 'src/c/main_controller.php';
require_once 'config/connexion_sql.php';
require_once 'getRacine.php';

if(isset($_GET["action"])) {
    $action = $_GET["action"];
} 
else {
    $action = "defaut";
}

$fichier = main_controller($action);
include "$racine/src/c/$fichier";
