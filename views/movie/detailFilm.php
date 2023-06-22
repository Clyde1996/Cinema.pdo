<?php
    ob_start(); //Start output buffering 

    //demarre le temporisation de sortie
?>

<div class="card detail-film-card">

<?php
    $detailFilm = $detailFilm->fetch(); // while fetch quand c'est plusieur fois, et fetch sans while quand c'est une fois
?>

    <h2><?= $detailFilm['titre_film']?></h2> <!-- Output some content -->

    <a href="index.php?action=trailerFilm&id=<?= $detailFilm['id_film'] ?>">
        <figure class="figure_detailFilm">
            <img src="<?= $detailFilm['image']?>" alt="1" class="img_detailFIlm">
        </figure>
    </a>
    
    <!--<iframe width="560" height="315" src="https://www.youtube.com/embed/=<?$detailFilm['trailer']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> -->


<!-- Synopsis -->
<?php
    echo "<h3>Synopsis :</h3>";

    echo "<p>" . $detailFilm["synopsis"] . "</p>";

?>

<!-- Acteurs du film -->
<?php

    echo "<h3>Acteurs du film :</h3>";

    while ($casting = $castingFilm ->fetch()){   // fetch - ca recupere les dones dans le database Sql 'on a boucle'

        echo "<p>" . $casting["acteurFilm"] . "</p>";
    }

?>

<!-- Realisateurs du film -->
<?php
    echo "<h3>Realisateur du film :</h3>";

    echo "<p>" . $detailFilm["realisateur_Film"] . "</p>";

?>

<!-- Genres du film -->
<?php

    echo "<h3>Genres du film :</h3>";

    while ($genre = $genresFilm->fetch()){   // fetch - ca recupere les dones dans le database Sql 'on a boucle'
        echo "<p>" . $genre["nom"] . "</p>";
    }

?>


</div>

<?php

    $title = "Detail Film";
    $content = ob_get_clean(); //Capture the output buffer and end buffering 
    require "views/template.php"; //ca fait le lien avec template

?>
