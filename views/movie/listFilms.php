<?php
ob_start(); //Start output buffering 

//demarre le temporisation de sortie 


?>
<div class="card card-unique detail-film-card">
<h2>Liste des films</h2> <!-- Output some content -->

<h3>Il y a <?= $films->rowCount()?> films dans la base de données :</h3>

<!-- je vais devoir fectchALL -->
<?php
while ($film = $films->fetch()){   // fetch - ca recupere les dones dans le database Sql

    // echo $film["id_film"];

    // echo $film["synopsis"];

?>

    

    <a href="index.php?action=detailFilm&id=<?= $film["id_film"]?>">
        <h3><?= $film["titre_film"] ?></h3>
    </a>


<?php
}
?>
</div>
<?php

$title = "liste des films";
$content = ob_get_clean(); //Capture the output buffer and end buffering 
require "views/template.php"; //ca fait le lien avec template

?>