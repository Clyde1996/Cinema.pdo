<?php


class GenreController{


    public function findAllGenres(){

        $dao = new DAO();

        $sql = "SELECT g.id_genre, g.nom FROM genre g";

        $genres = $dao->executerRequete($sql);

        require "views/genre/listGenres.php";
    }


    public function findGenreById($id) {
        $dao = new DAO();
        
        $sql1 = "SELECT 
        f.titre_film,
        g.nom AS film_genre,
        fi.id_film,
        g.id_genre
        
        FROM film f
        
        INNER JOIN film_genre_link fi
            ON f.id_film = fi.id_genre
        INNER JOIN genre g
            ON g.id_genre = fi.id_genre
        Where
            g.id_genre = :id
        
        ORDER BY
        film_genre
        ";

        $genre = $dao->executerRequete($sql1, [":id" => $id]);
        require "views/genre/detailGenre.php";
         
    }


    public function findOneGenreById($id) {

        $dao = new DAO();
        
        $sql1 = "SELECT 
            id_genre,
            nom
        FROM
            genre
        Where
            id_genre = :id
        ";

        $genre = $dao->executerRequete($sql1, [":id" => $id]);

        require "views/genre/detailGenre.php";
    }

   

// Attention : Si on delete un genre, il n'y a plus rien dans la table appartenir et donc ça créé des erreurs SQL à l'édition d'un film.
    public function deleteOneGenreById($id){
            
        $dao = new DAO();

        $sql2 = "DELETE FROM genre g
                WHERE id_genre = $id
                ";

        $deleteGenre = $dao->executerRequete($sql2); 

        $this->findAllGenres(); // Appelle la fonction findAllFilms pour retourner à la liste des films
    }

    public function addGenre(){

       // $id_genre = filter_input(INPUT_POST, "id_genre", FILTER_VALIDATE_INT); //FILTER_VALIDATE_INT : Filtre pour entier (int)
       $nomGenre = filter_input(INPUT_POST, "nomGenre", FILTER_SANITIZE_FULL_SPECIAL_CHARS); //FILTER_SANITIZE_FULL_SPECIAL_CHARS : filtre pour varchar

       //Requette Sql

       $dao = new DAO();

       $sql3 = "INSERT INTO genre (id_genre, nom)
                VALUES(NULL, :nom)";
        
        $dao->executerRequete($sql3, [":nom" => $nomGenre]);
        
        $this->findAllGenres();
    }

    public function updateGenre($idGenre){

       $nomGenre = filter_input(INPUT_POST, "nomGenre", FILTER_SANITIZE_FULL_SPECIAL_CHARS); //FILTER_SANITIZE_FULL_SPECIAL_CHARS : filtre pour varchar

       //Requette Sql

       $dao = new DAO();

       $sql3 = "UPDATE genre
        SET nom = :nom
        WHERE id_genre = :idGenre";
        
        $dao->executerRequete($sql3, [":idGenre" => $idGenre, ":nom" => $nomGenre]);
        
        $this->findAllGenres();
    }

    public function addOrUpdateGenreForm($idGenre){

        $dao = new DAO();

        $genre;

        if ($idGenre) { // update

            $sql1 = "SELECT
                    id_genre AS idGenre,
                    nom AS nomGenre
                FROM 
                    genre
                WHERE
                    id_genre = :idGenre
                ;
            ";

            $genre = $dao->executerRequete($sql1, [":idGenre" => $idGenre])->fetch();

        // } else { // add

        }

        require "views/genre/addOrUpdateGenreForm.php";
        
    }

    
}

?>