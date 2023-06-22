<?php
    ob_start(); //Start output buffering 

    //demarre le temporisation de sortie
?>

<?php
    $genre = $genre->fetch();
?>

<div class="card card-unique detail-genre-card">

    <a href="index.php?action=addOrUpdateGenreForm&id=<?= $genre["id_genre"] ?>" class="top-right-corner">
        <i class="fa-regular fa-pen-to-square"></i>
    </a>

    <h2>Genre <?= $genre["nom"] ?><h2>

    <label>Nom : </label>
    <h3><?= $genre["nom"] ?></h3>

</div>

<?php

    $title = "Detail Genre " . $genre['nom'];
    $content = ob_get_clean(); //Capture the output buffer and end buffering 
    require "views/template.php"; //ca fait le lien avec template

?>