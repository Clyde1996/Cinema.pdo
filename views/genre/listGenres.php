<?php
ob_start();  // This is NECESSARY for the next ob_get_clean() to work as intended.


//demarre le temporisation de sortie 


?>

<div class="card card-unique list-realisateurs-card">

    <h2>Liste des genres</h2>

    <h3>Il y a <?= $genres->rowCount() ?> genres de film dans la base de données :</h3>

    <!-- je vais devoir fectchALL -->
    <?php
        while ($genre = $genres->fetch()){ // fetch - ca recupere les dones dans le database Sql

    ?>

            <div class="flex-row-center trash-parent">

                <a href="index.php?action=detailGenre&id=<?= $genre["id_genre"] ?>">
                    <h3><?= $genre["nom"] ?></h3>
                </a>

                <!-- DELETE (trash/corbeille/poubelle) -->
                <a href="index.php?action=deleteGenre&id=<?= $genre["id_genre"] ?>">
                    <i class="fa-solid fa-trash-can"></i>
                </a>

            </div>
           

    <?php

            /*<a href=""></a>*/
        }
    ?>

    <div class="add_buttonGenre">
    
        <a href="index.php?action=addOrUpdateGenreForm">
            <!-- <i class="fa-sharp fa-light fa-circle-plus"></i> -->
            <!-- <i class="fa-duotone fa-circle-plus" style="--fa-primary-color: #ffffff; --fa-secondary-color: #6c7584;"></i> -->
            <i class="fa-sharp fa-solid fa-circle-plus fa-lg" style="color: #ffffff;"></i>
        </a>

    </div>

</div>

<?php

$title = "liste des genres";
$content = ob_get_clean();
require "views/template.php"; //ca fait le lien avec template

?>