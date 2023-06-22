<?php
ob_start();  // This is NECESSARY for the next ob_get_clean() to work as intended.


//demarre le temporisation de sortie 


?>

<div class="card card-unique list-acteurs-card">

    <h2>Liste des acteurs</h2> <!-- Output some content -->

    <h3>Il y a <?= $listActeurs->rowCount()?> acteurs dans la base de données :</h3>











    <!-- je vais devoir fectchALL -->
    <?php
        while ($acteur = $listActeurs->fetch()){  // fetch - ca recupere les dones dans le database Sql
        // $listActeurs on a cree dans le personControler

    ?>

            <a href="index.php?action=detailActeur&id=<?= $acteur["id_acteur"] ?>">
                <h3><?= $acteur["nomCompletActeur"] ?></h3> <!-- CONCAT dans le movieController nom + prenom AS nomCompletActeur -->
            </a>

    <?php

        }
    ?>

</div>

<?php
$title = "liste des acteurs";
$content = ob_get_clean(); //Capture the output buffer and end buffering 
require "views/template.php"; //ca fait le lien avec template
?>