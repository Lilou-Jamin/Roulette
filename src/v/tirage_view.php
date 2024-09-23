<div class="bg-white">
<h2 class="text-2xl bg-white p-5">Tirage</h2>

<form class="px-5" method="POST" action="./?action=tirage">
    <?php 
        // On affiche les élèves en liste d'attente
        foreach($elevesattente as $e){ ?>
            <ul>
                <li> 
                    <span class=""><?= $e['nom'] ?></span>
                    <span class="italic"><?= $e['prenom'] ?></span>
                </li>
            </ul>
        <?php } 

        if(isset($elevetire)){?>
            <span class="">L'élu(e) est : <?= $elevetire["nom"]?> <?=$elevetire["prenom"]; ?></span><br><?php }
    ?>

    <input class="pt-2 font-bold" type="submit" name="tirer" value="TIRER"></input>
</form>

<?php 
    // Si on clique sur le bouton "tirer" alors on affiche le panel de notation
    if(isset($_POST['tirer'])){?>
        <form class='px-5 border-2 border-black w-64' method='POST' action='./?action=tirage'>
            <label>Note de l'élève</label>
            <select name="note" id="note">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select><br>

            <input class="pt-2 font-bold" type="submit" name="noter" value="AJOUTER NOTE"></input>
        </form>

        <form class='px-5 border-2 border-black w-64' method='POST' action='./?action=tirage'>
            <input class="pt-2 font-bold" type="submit" name="mettre_absent" value="NOTER ABSENT"></input>
        </form>
<?php } ?>

<form class="pl-5" method="POST" action="">
    <input class="font-bold" type="submit" name="reset_passages" value="RESET PASSAGES"></input>
</form>

<form class="pl-5" method="POST" action="">
    <input class="font-bold" type="submit" name="reset_notes" value="RESET NOTES"></input>
</form>

</div>