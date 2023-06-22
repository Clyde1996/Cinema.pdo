<?php
ob_start();  // This is NECESSARY for the next ob_get_clean() to work as intended.


//demarre le temporisation de sortie 


?>

<div class="card card-unique list-realisateurs-card">

    <h2>Liste des realisateurs</h2>

    <h3>Il y a <?= $findAllRealisateurs->rowCount()?> realisateurs dans la base de données :</h3> <!-- On a compte les realisateurs, depuis le base de donees avec le requete sql que on a fait sur Persoj-->

    <!-- je vais devoir fectchALL -->
    <?php
    while ($realisateur = $findAllRealisateurs->fetch()){  // fetch - ca recupere les dones dans le database Sql

        // echo $realisateur["id_realisateur"], $realisateur["realisateur"];

        // echo $film["synopsis"];

    ?>

        

        <a href="index.php?action=detailRealisateur&id=<?= $realisateur["id_realisateur"] ?>">
            <h3><?= $realisateur["realisateur"] ?></h3> <!-- CONCAT dans le movieController nom + prenom = realisateur_Film -->
        </a>

    <?php

    }
    ?>

</div>

<?php

$title = "liste des realisateurs";
$content = ob_get_clean(); // Capture the output buffer and end buffering
require "views/template.php"; //ca fait le lien avec template

?>