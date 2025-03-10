<div class="bg-white flex flex-col justify-center p-12">
    <h1 class="text-2xl font-semibold mb-4"> Informations de <?=$eleve_info['prenom_eleve']?> <?=$eleve_info['nom_eleve']?> :</h1> 
    
    <div class="flex flex-row items-center space-x-2">
        <h2 class="text-xl font-semibold"> Classe : </h2>
        <span class="text-xl"> <?=$eleve_info['nom_classe']?> </span>
    </div>

    <div class="">
        <h2 class="text-xl font-semibold"> Passages effectués : </h2> 
        <?php foreach($eleve_passages as $ep){ ?>
            <div class="">
                <?php
                    $date = $ep['date_passage'];
                    $timestamp = strtotime($date);
                    $date = date('d-m-Y', $timestamp);
                    $heure = date('H:i', $timestamp);
                ?>
                <p> Passage le <?= $date ?> à <?= $heure ?> : </p>
                <p> Note : <?= $ep['note'] ?> </p>
            </div>
        <?php } ?>
    </div>
</div>

