<?php
ob_start();  // This is NECESSARY for the next ob_get_clean() to work as intended.


//demarre le temporisation de sortie


// par défaut on considère qu'on est en ajout/création/add
$titrePage = "Création d'un nouveau genre";
$actionGet = "addGenre";


// si c'est un update
if (isset($idGenre)) {
    $titrePage = "Modification du genre " . $genre["nomGenre"];
    $actionGet = "updateGenre&id=" . $idGenre;
} else {
    // sinon c'est un add
    $genre = [
        "nomGenre" => ""
    ];
}

?>

<div class="card card-unique genre-form-card">

    <h2><?= $titrePage ?></h2>

    <form action="index.php?action=<?= $actionGet ?>" method="post">

        <label for="nomGenre">Nom du genre</label>
        <input type="text" id="nomGenre" name="nomGenre" value="<?= $genre["nomGenre"] ?>" />
        <!-- id pour recevoir le focus sur l'input quand on clique sur le label correspondant (label.for == input.id) -->
        <!-- name pour que la value soit envoyée dans le formulaire en POST (sera récupéré dans le contrôleur) -->

        <button type="submit">Enregistrer</button>

    </form>

</div>

<?php

$title = $titrePage;
$content = ob_get_clean();
require "views/template.php"; //ca fait le lien avec template

?>