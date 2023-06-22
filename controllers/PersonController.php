<?php

class PersonController{
    


    public function findAllPersonnes(){

        $dao = new DAO();

        $sql = "SELECT p.id_personne, p.nom, p.prenom, p.date_naissance, p.sex FROM personne p"; // on select les colones dans le base de donees

        $personnes = $dao->executerRequete($sql);

        require "views/realisateur/listRealisateurs.php";
    }

    public function findAllRealisateurs(){

        $dao = new DAO();

        $rSql = "SELECT 
            CONCAT(p.nom,' ', p.prenom) AS realisateur, 
            r.id_realisateur,
            p.id_personne

        FROM	personne p, realisateur r

        WHERE 
            p.id_personne = r.id_personne -- le lien obligatoire entre Personne et Réalisateur, équivalent au 'ON' de 'INNER JOIN'
        ORDER BY
            r.id_realisateur"
        ;

        $findAllRealisateurs = $dao->executerRequete($rSql);

        require "views/realisateur/listRealisateurs.php";
        ;
    }


    public function findOneRealisateurById($id) {
        
        $dao = new DAO();
        
        $rSql1 = "SELECT 
                CONCAT(p.nom,' ', p.prenom) AS nomCompletR, 
                r.id_realisateur,
                p.id_personne

            FROM	personne p, realisateur r

            WHERE 
                p.id_personne = r.id_personne -- le lien obligatoire entre Personne et Réalisateur, équivalent au 'ON' de 'INNER JOIN'
                AND r.id_realisateur = :id -- filtre, pour ne récupérer que le réalisateur dont l'id_realisateur est égal à $id
                
            ORDER BY
                nomCompletR"
        ;

        $realisateur = $dao->executerRequete($rSql1, [":id" => $id]); //[":id" => $id] -> params : tableau associatif qui contient les valeurs à utiliser/échanger (les ":truc" seront remplacés dans la requête SQL par la valeur d'une variable $truc si on fournit [":truc" => $truc])
        // ATTENTION : toujours filtrer (avec le FILTER SANITIZE approprié en fonction du type) les données reçues du client (de l'"extérieur")

        require "views/realisateur/detailRealisateur.php";
    }

    public function findAllActeurs(){
        $dao = new DAO();
        
        $aSql = "SELECT 
                CONCAT(p.prenom,' ',p.nom) AS nomCompletActeur,
                a.id_personne,
                a.id_acteur

            FROM
                personne p
                INNER JOIN acteur a
                    ON p.id_personne = a.id_personne

            ORDER BY
                p.nom,
                p.prenom
        ";

        $listActeurs = $dao->executerRequete($aSql);

        require "views/actor/listActors.php";
    }
}



?>