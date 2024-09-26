<div class="bg-white mt-6 p-6 w-[30%] mx-auto shadow-lg">

    <form method="POST" action="./?action=tirage">
        <h1 class="text-2xl font-semibold mb-4">Liste d'attente :</h1> 
        <?php 
            // On affiche les élèves en liste d'attente
            foreach($elevesattente as $e){ ?>
                <ul class="list-disc pl-6">
                    <li class="flex items-center space-x-2">
                        <span class="font-semibold"><?= $e['nom'] ?></span>
                        <span><?= $e['prenom'] ?></span>
                    </li>
                </ul>
            <?php } 

            if(isset($elevetire)){?>
                <span class="block mt-4 font-bold">L'élève choisit est : <?= $elevetire["nom"]?> <?=$elevetire["prenom"]; ?></span><br>
            <?php } 
        ?>

        <input type="submit" name="tirer" value="TIRER" class="mt-6 bg-blue-500 text-white py-2 px-4 rounded font-bold cursor-pointer">
    </form>

    <?php 
        // Si on clique sur le bouton "tirer" alors on affiche le panel de notation
        if(isset($_POST['tirer'])){?>
            <form class='mt-8 p-4 border-2 border-gray-300 rounded-lg' method='POST' action='./?action=tirage'>
                <label class="block mb-2 text-gray-700">Note de l'élève</label>
                <select class="w-full p-2 mb-4 border border-gray-300 rounded" name="note" id="note">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
                <input type="submit" name="noter" value="AJOUTER NOTE" class="w-full bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition font-bold cursor-pointer">
            </form>

            <form class='mt-4 p-4 border-2 border-gray-300 rounded-lg' method='POST' action='./?action=tirage'>
                <input type="submit" name="mettre_absent" value="NOTER ABSENT" class="w-full bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 transition font-bold cursor-pointer">
            </form>
    <?php } ?>

    <form class="mt-6" method="POST" action="">
        <input type="submit" name="reset_passages" value="RÉINITIALISER LISTE D'ATTENTE (passages)" class="bg-blue-300 text-white py-2 px-4 rounded hover:bg-blue-600 transition font-bold cursor-pointer">
    </form>

    <form class="mt-4" method="POST" action="">
        <input type="submit" name="reset_notes" value="RÉINITIALISER NOTES" class="bg-blue-300 text-white py-2 px-4 rounded hover:bg-blue-600 transition font-bold cursor-pointer">
    </form>

    <h1 class="text-2xl font-semibold my-4">Élèves passés :</h1> 
    <?php 
        // On affiche les élèves qui sont déjà passés
        foreach($elevespasses as $ep){ ?>
            <ul class="list-disc pl-6">
                <li class="flex items-center space-x-4">
                    <span class="font-medium"><?= $ep['nom'] ?></span>
                    <span><?= $ep['prenom'] ?></span>
                    <span><?= $ep['moyenne'] ?></span>
                </li>
            </ul>
        <?php } 
    ?>

</div>
