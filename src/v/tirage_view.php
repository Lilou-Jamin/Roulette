<div class="bg-white">
<h2 class="text-2xl bg-white p-5">Tirage</h2>

<form method="POST" action="./?action=tirage">
    <?php 
        foreach($listeElevesParClasseSection as $e): ?>
            <ul>
                <li> 
                    <span class=""><?= $e['nom'] ?></span>
                    <span class=""><?= $e['prenom'] ?></span>
                </li>

            </ul>
        <?php endforeach; 
    ?>

    <input type="submit" name="tirer" value="TIRER"></input>
</form>

</div>