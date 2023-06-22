<!-- définition
bdd -- base de donnes
DAO data acces object
PDO un extention qui permetre de connecter a la base de donnes--> 

<?php

class DAO{
    private $bdd; // bdd- base de donnes

    public function __construct(){
        $this->bdd = new PDO('mysql:host=localhost;dbname=cinema.pdo;charset=utf8', 'root', ''); //'root' -> username, et ' ' -> password
    }

    function getBDD(){
        return $this->bdd;
    }

    public function executerRequete($sql, $params = NULL){
        if ($params == NULL){
            $resultat = $this->bdd->query($sql); // query a definir : Exécute une requête sur la base de données
        }else{
            $resultat = $this->bdd->prepare($sql);
            $resultat->execute($params);
        }
        return $resultat;

    }
}