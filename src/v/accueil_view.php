<?php
require 'src/v/base_view.php';
require_once 'src/c/accueil_controller.php';
?>

<div class="bg-white flex flex-col justify-center pt-8">
    <form method="POST" action="./?action=tirage">
        <label> Sélectionner la classe : </label>
        <select name="select_classe" id="select_classe" class="rounded-lg p-2 w-[40]">
            <?php
                // Affiche les différentes classes dans un menu déroulant
                foreach($listeClasses as $c){
                    echo "<option name='classe_eleve' value=".$c['section'].">".$c['section']."</option>";
                }
            ?>
        </select>

        <input type="submit" name="submit" value="CHOISIR"></input>
    </form>

    <!-- Assigne la classe sélectionnée à une variable de session -->
    <?php if (isset($_POST['select_classe'])){
                    $_SESSION['select_classe'] = $_POST['select_classe'];
                }else{
                    echo "Aucune classe n'a été séléctionnée.";
                }?>
    
    <!-- Affiche les élèves triés par classe
    <?php 
        foreach($listeClasses as $c): ?>
            <h3 class="text-xl font-bold px-5 underline"><?= $c['section'] ?></h3>
            
            <table class="table-auto m-5 border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Nom</th>
                        <th class="border border-gray-300 px-4 py-2">Prénom</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($listeElevesParClasseSection[$c['section']])): ?>
                        <?php foreach($listeElevesParClasseSection[$c['section']] as $ec): ?>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2"><?= $ec['nom'] ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= $ec['prenom'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" class="border border-gray-300 px-4 py-2 text-center">Aucun élève dans cette classe</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endforeach; 
    ?>-->


    <!-- Affiche tous les élèves
    <h3 class="text-xl font-bold px-5 underline">Liste de tous les élèves :</h3>
    <table class="table-auto m-5">
        <th>
            <tr>
                <th class="border border-gray-300 px-4 py-2">Nom</th>
                <th class="border border-gray-300 px-4 py-2">Prénom</th>
            </tr>
        </th>
        <tbody>
            <?php foreach($listeEleves as $e): ?>
                <tr>
                    <td class="border border-gray-300 px-4 py-2"><?= $e['nom']?></td>
                    <td class="border border-gray-300 px-4 py-2"><?= $e['prenom']?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table> -->
</div>