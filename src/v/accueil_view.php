<?php
require 'src/v/base_view.php';
require_once 'src/c/accueil_controller.php';
?>

<div class="bg-white flex flex-col justify-center p-12">

    <form method="POST" action="./?action=tirage" class="mb-4">
        <label class="text-2xl font-semibold"> Sélectionner la classe : </label>
        <select name="select_classe" id="select_classe" class="text-xl rounded-lg p-2 w-[40]">
            <!-- Affiche les différentes classes dans un menu déroulant -->
            <?php foreach($listeClasses as $c){
                    echo "<option name='classe_eleve' value=".$c['id_classe'].">".$c['nom_classe']."</option>";
                }
            ?>
        </select>

        <input class="bg-blue-500 text-white py-1 px-2 rounded cursor-pointer text-xl" type="submit" name="submit" value="CHOISIR"></input>
    </form>

    <!-- On assigne la classe sélectionnée à une variable de session -->
    <?php if (isset($_POST['select_classe'])){
        $_SESSION['select_classe'] = $_POST['select_classe'];
    }?>
    
    <!-- Affiche tous les élèves -->
    <h1 class="text-2xl font-semibold"> Liste des tous les élèves : </h1> 
    <table class="table-auto m-4 max-w-2xl text-lg">
        <th>
            <tr>
                <th class="border border-gray-300 px-4 py-2"> Nom </th>
                <th class="border border-gray-300 px-4 py-2"> Prénom </th>
                <th class="border border-gray-300 px-4 py-2"> Informations </th>
            </tr>
        </th>
        <tbody>
            <?php foreach($listeEleves as $e): ?>
                <tr>
                    <td class="border border-gray-300 px-4 py-2"><?= $e['nom_eleve']?></td>
                    <td class="border border-gray-300 px-4 py-2"><?= $e['prenom_eleve']?></td>
                    <td class="border border-gray-300 px-4 py-2 underline"><a href="./?action=info&id_eleve=<?= $e['id_eleve'] ?>"> Voir plus </a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>