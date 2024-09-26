<?php
function main_controller($action) {
    $lesActions = [];
    $lesActions["defaut"] = "accueil_controller.php";
    $lesActions["tirage"] = "tirage_controller.php";

    // Si on a sélectionné une classe alors on la garde en variable de session
    if (isset($_POST['select_classe'])){
        $_SESSION['select_classe'] = $_POST['select_classe'];
    }

    if (array_key_exists($action, $lesActions)) {
        return $lesActions[$action];
    }else{
        return $lesActions["defaut"];
    }
}