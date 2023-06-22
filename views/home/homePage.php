<?php
ob_start();

//demarre le temporisation de sortie 


?>

<h2>Ceci est un page d'accueil</h2>


<?php

$title = "Allocine ";
$content = ob_get_clean();
require "views/template.php"; //ca fait le lien avec template

?>