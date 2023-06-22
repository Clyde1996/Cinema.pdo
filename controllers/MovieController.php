<?php

require_once "bdd/DAO.php";

class MovieController{


    public function findAllFilms(){   // find all films / trouve tout les films 

        $dao = new DAO(); // new dao -  new data base

        $sql = "SELECT f.id_film, f.titre_film, f.synopsis FROM film f";  // on a selectione les items dans le database

        $films = $dao->executerRequete($sql); 

        require "views/movie/listFilms.php";
    }


    public function findOneFilmById($id) {   // find movie par id/ trouve le film par id

// on veut quoi dans cette fonction ? récupérer 1 film, son réalisateur (1), ses genres (n), ses [acteurs et rôle lié] (n distributions/castings, puis ds chq casting 1 acteur + 1 rôle)

        $dao = new DAO(); // new dao -  new data base

        // $sql = "SELECT f.id_film, f.titre_film, f.synopsis, f.trailer, f.image FROM film f Where f.id_film = :id";
        
        // $film = $dao->executerRequete($sql,[":id" => $id]);

// film contient quoi ? 1 film => parfait (y)
        
    

        // $dao = new DAO(); //dao : data base / base de donnes 
        // Jointures
        $sql1 = "SELECT f.id_film AS id_film,          
            f.titre_film AS titre_film,
            f.note AS note,
            CONCAT(p.prenom,' ', p.nom) AS realisateur_Film, -- concat = pour mettre ensamble not et prenom
            DATE_FORMAT(SEC_TO_TIME(f.duree*60), '%H:%i') AS duree, -- on a transforme les minutes en en format heure et minutes / h m 
            f.image, 
            f.synopsis,
            f.trailer,
            f.id_realisateur
            FROM film f
            -- INNER JOIN film_genre_link fg
            --     ON fg.id_film = f.id_film 
            
            -- INNER JOIN genre g 
            --     ON	g.id_genre = fg.id_genre
            
            INNER JOIN realisateur r
                ON f.id_realisateur = r.id_realisateur
            
            INNER JOIN personne p
                ON p.id_personne = r.id_personne	
            

        WHERE
            f.id_film = :id
            
        GROUP BY
            f.id_film"
            ;

        $detailFilm = $dao->executerRequete($sql1, [":id" => $id]);

// detailFilm contient quoi ? 1 film, son réalisateur (1) [avec la personne liée (1)] OK
// NOK : contient aussi les genres liés (n)
// après chgmts : detailFilm contient 1 film et son réalisateur


        $sql2 = "SELECT 
            CONCAT(p.prenom,' ', p.nom) AS acteurFilm, -- concat = pour mettre ensamble not et prenom
            ro.nom,
            -- f.titre_film,
            a.id_acteur AS idActeur
            
            -- FROM distribution d, acteur a, film f, role ro, personne p
            FROM distribution d, acteur a, role ro, personne p

            WHERE 
                    p.id_personne = a.id_personne

                And
                    a.id_acteur = d.id_acteur
                -- AND
                --     d.id_film = f.id_film
                And
                    ro.id_role = d.id_role
                And
                    -- f.id_film = :id
                    d.id_film = :id
                    
            ORDER BY
                acteurFilm"
        ;
        $castingFilm = $dao->executerRequete($sql2, [":id" => $id]);    // casting du film 

// castingFilm contient quoi ? 1 film, ses distributions/castings (n), ses acteurs (n) et ses rôles (n)
// presque parfait pour distribution/casting => pour être parfait, on enlévera juste la table film
// après chgmts : castingFilm contient n castings (acteur [+personne] + rôle)


        
        $sql3 = "SELECT 
            -- f.titre_film,
            fi.id_film,
            fi.id_genre,
            g.nom

            -- FROM film f

            -- INNER JOIN film_genre_link fi -- LEFT JOIN == LEFT OUTER JOIN == si 'à droite' le lien est NULL alors la ligne sera quand même récupérée // != INNER JOIN qui impose que les valeurs soient égales
            --     ON fi.id_film = f.id_film
            
            FROM film_genre_link fi
                
            INNER JOIN genre g
                ON g.id_genre = fi.id_genre 
            Where
                    -- f.id_film = :id
                    fi.id_film = :id
            ORDER BY 
                -- f.titre_film,
                g.nom"
        ;
        $genresFilm = $dao->executerRequete($sql3, [":id" => $id]);  // film genre : action, aventure ....

// genresFilm contient quoi ? 1 film, ses genres (n)
// presque parfait pour les genres du film => pour être parfait : retirer la table film
// après chgmts : genresFilm contient n genres


        require "views/movie/detailFilm.php";
    }

    public function addFilm($array){  //Function pour ajouter un neuveau film 
    
        // les filtres aux inputs pour éviter les injections SQL ou XSS
    $id_film = filter_input(INPUT_POST, "id_film", FILTER_VALIDATE_INT); // FILTER_VALIDATE_INT : Filtre pour entier (int)
    $id_realisateur = filter_input(INPUT_POST, "id_realisateur", FILTER_VALIDATE_INT); // FILTER_VALIDATE_INT : Filtre pour entier (int)
    $titre_film = filter_input(INPUT_POST, "titre_film", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $date_sortie = filter_input(INPUT_POST, "date_sortie", FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
    $duree = filter_input(INPUT_POST, "duree", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $synopsis = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $note = filter_input(INPUT_POST, "note", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $affiche = filter_input(INPUT_POST, "affiche", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $image = filter_input(INPUT_POST, "image", FILTER_SANITIZE_FULL_SPECIAL_CHARS);  //FILTER_SANITIZE_FULL_SPECIAL_CHARS : filtre pour varchar
    $trailer = filter_input(INPUT_POST, "trailer", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //Les requêtes SQL pour ajouter les réalisateurs les castings et les genres aux films

    $dao = new Dao();

    $sql1 = "INSERT INTO film (id_film, id_realisateur, titre_film, date_sortie, duree, synopsis, note, affiche, image, trailer)
            VALUES(:id_film, :id_realisateur, :titre_film, :date_sortie, :duree, :synopsis, :note, :affiche, :image, :trailer)";
    
    $sql2 = "INSERT INTO film_genre_link(id_genre, id_film)                                                                              
            VALUES (:id_genre, :id_film)"; 

    }

}




?>