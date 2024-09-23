<div class="bg-white">
<h2 class="text-2xl bg-white p-5">Tirage</h2>

<form class="px-5" method="POST" action="./?action=tirage">
    <?php 
        foreach($elevesattente as $e){ ?>
            <ul>
                <li> 
                    <span class=""><?= $e['nom'] ?></span>
                    <span class="italic"><?= $e['prenom'] ?></span>
                </li>

            </ul>
        <?php } 

        if(isset($elevetire)){?>
            <span class="">L'élu est : <?= $elevetire["nom"]?> <?=$elevetire["prenom"]; ?></span><br><?php
        }
    
    ?>

    <input class="pt-2 font-bold" type="submit" name="tirer" value="TIRER"></input>
</form>

<?php 
if(isset($_POST['tirer'])){?>
    <form class='px-5' method='POST' action='./?action=tirage'>
    <label>Note de l'élève</label>
    <select name="note" id="note">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select> 

    <label>L'élève est-il absent ?</label>
    <select name="absent" id="absent">
        <option value="absentOui">Oui</option>
        <option value="absentNon">Non</option>
    </select> 

    <input class="pt-2 font-bold" type="submit" name="noter" value="CONFIRMER"></input>
</form>
<?php } ?>

<form class="pl-5" method="POST" action="">
    <input class="font-bold" type="submit" name="reset_passages" value="RESET PASSAGES"></input>
</form>

<form class="pl-5" method="POST" action="">
    <input class="font-bold" type="submit" name="reset_notes" value="RESET NOTES"></input>
</form>

</div>