<?php
require 'src/v/base_view.php';
require_once 'src/c/accueil_controller.php';
?>

<h2 class="text-2xl p-5">Accueil</h2>

<div class="flex flex-col justify-center px-[35%]">
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
    </table>


    <?php foreach($listeClasses as $c): ?>
        <h3 class="text-xl font-bold px-5 underline"><?= $c['section'] ?></h3>
        
        <table class="table-auto m-5 border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Nom</th>
                    <th class="border border-gray-300 px-4 py-2">Prénom</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($listeElevesParClasse[$c['id_classe']])): ?>
                    <?php foreach($listeElevesParClasse[$c['id_classe']] as $ec): ?>
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
    <?php endforeach; ?>
</div>
<?php
var_dump($listeMoyennes);
?>