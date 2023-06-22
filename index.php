<?php

// je demande l'acces au fichier physique soit j'utilise un auto
require_once "controllers/HomeController.php";
require_once "controllers/PersonController.php";
require_once "controllers/RoleController.php";
require_once "controllers/MovieController.php";
require_once "controllers/GenreController.php";


// je cree des instances des controlleurs

$homeCtrl = new HomeController();
$personCtrl = new PersonController();
$filmCtrl = new MovieController();
$roleCtrl = new RoleController();
$genreCtrl = new GenreController();

// l'index  va intercepter la requete HTTP et va orienter vers le 

//ex: index.php?action=listFilms

/*/isset() is a PHP function used to determine if a variable is set and not null. In this case, it checks if the "action" key is set in the $_GET array.*/
if(isset($_GET['action'])){  

    $id = filter_input(INPUT_GET, "id",  FILTER_SANITIZE_FULL_SPECIAL_CHARS); // pour se proteger des hackeurs - de faille xss
    // liste des filtres (en fonction du type de donnée) : https://www.php.net/manual/en/filter.filters.sanitize.php
    // par défaut, pour les types qui n'ont pas de filtre spécifique et aussi pour les String : FILTER_SANITIZE_FULL_SPECIAL_CHARS

    // méthodes (methods) pour l'envoi de données depuis le client (navigateur) et réception dans le serveur (où nous sommes, en PHP) :
    // - GET : les pairs propriété/valeur sont dans l'URL (ex. ...?action=listActors) et récupérées dans la superglobale $_GET
    // - POST : les pairs propriété/valeur sont dans un corps/body invisible mais envoyées et récupérées dans la superglobale $_POST

    switch($_GET['action']){
        case "listFilms" : $filmCtrl->findAllFilms(); break;
        case "detailFilm" : $filmCtrl->findOneFilmById($id); break; // We use break to prevent the code from running into the next case automatically.
        case "listRealisateurs" : $personCtrl->findAllRealisateurs(); break;  // Liste Realisateur
        case "detailRealisateur" : $personCtrl->findOneRealisateurById($id); break; // Detail Realisateur 
        case "listActors" : $personCtrl->findAllActeurs(); break; // Liste Acteur 
        case "listGenres" : $genreCtrl->findAllGenres(); break; // List Genre
        case "detailGenre" : $genreCtrl->findOneGenreById($id); break; // List Genre

        //Delete  Genres
        case "deleteGenre" : $genreCtrl->deleteOneGenreById($id); break; // Delete Genre 

        //Ajouter nouveaux Genres4
        case "addOrUpdateGenreForm" : $genreCtrl->addOrUpdateGenreForm($id); break; // Add Or Update Genre Form 
        case "addGenre" : $genreCtrl->addGenre(); break; // Add Genre
        case "updateGenre" : $genreCtrl->updateGenre($id); break; // update Genre

        default :
            $homeCtrl->homePage();break; // homepage : acceuil 
    }

    // switch($_GET['action']){
    //     case "listGenres" : $genreCtrl->findAllGenres(); break; 
    //     default :
    //         $homeCtrl->homePage();break;
    // }

}

else{

    $homeCtrl->homePage();
}

// Temporisation de sortie

?>