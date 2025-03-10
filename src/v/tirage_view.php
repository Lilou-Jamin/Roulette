<div class="bg-white flex flex-col justify-center p-12">
    <div class="flex flex-row items-center space-x-2">
        <h1 class="text-2xl font-semibold underline">Tirage du : </h1> 
        <span class="text-2xl font-semibold bg-white"><?php echo date('d/m/y'); ?></span>
    </div>

    <form method="POST" action="./?action=tirage">
        <h1 class="text-2xl font-semibold mb-4">Liste d'attente :</h1> 
        <?php 
            // On affiche les élèves en liste d'attente
            foreach($elevesattente as $e){ ?>
                <ul class="list-disc pl-6 text-lg">
                    <li class="flex items-center space-x-2">
                        <span class="font-semibold"><?= $e['nom_eleve'] ?></span>
                        <span><?= $e['prenom_eleve'] ?></span>
                    </li>
                </ul>
            <?php } 

            if(isset($elevetire)){?>
                <span class="block mt-4 font-bold">L'élève choisit est : <?= $elevetire["nom_eleve"]?> <?=$elevetire["prenom_eleve"]; ?></span><br>
            <?php } 
        ?>

        <input type="submit" name="tirer" value="TIRER" class="my-6 bg-blue-500 text-white py-2 px-4 rounded font-bold cursor-pointer">
    </form>

    <?php 
        // Si on clique sur le bouton "tirer" alors on affiche le panel de notation
        if(isset($_POST['tirer'])){?>
        <div class="border-2 border-gray-300 rounded-lg max-w-xs space-y-2 p-4">
            <form method='POST' action='./?action=tirage'>
                <label class="block mb-2 text-gray-700"> Note de l'élève </label>
                <input class="w-full p-2 mb-4 border border-gray-300 rounded" type="number" name="note" min="0" max="20">

                <input type="submit" name="noter" value="AJOUTER NOTE" class="w-full bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition font-bold cursor-pointer">
            </form>

            <form method='POST' action='./?action=tirage'>
                <input type="submit" name="mettre_absent" value="NOTER ABSENT" class="w-full bg-red-500 text-white py-2 px-4 rounded hover:bg-red-800 transition font-bold cursor-pointer">
            </form>
        </div>
    <?php } ?>

    <form class="mt-6" method="POST" action="">
        <input type="submit" name="reset_passages" value="Réintinialiser les passages (pas les notes)" class="uppercase bg-red-500 text-white py-2 px-4 rounded hover:bg-red-800 transition font-bold cursor-pointer">
    </form>

    <form class="mt-4" method="POST" action="">
        <input type="submit" name="reset_notes" value="Réinitialiser les passages et les notes" class="uppercase bg-red-500 text-white py-2 px-4 rounded hover:bg-red-800 transition font-bold cursor-pointer">
    </form>


    <div class="max-w-2xl">
        <h1 class="text-2xl font-semibold my-4">Élèves passés :</h1> 
        <table class="min-w-full border border-gray-300 rounded-lg shadow-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left border">Nom</th>
                    <th class="px-4 py-2 text-left border">Prénom</th>
                    <th class="px-4 py-2 text-left border">Note</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($elevespasses as $ep) : ?>
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-4 py-2 border"><?= htmlspecialchars($ep['nom_eleve']) ?></td>
                        <td class="px-4 py-2 border"><?= htmlspecialchars($ep['prenom_eleve']) ?></td>
                        <td class="px-4 py-2 border"><?= htmlspecialchars($ep['note']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>