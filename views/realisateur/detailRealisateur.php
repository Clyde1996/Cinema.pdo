<?php
    ob_start(); //Start output buffering 

    //demarre le temporisation de sortie
?>

<?php
    $realisateur = $realisateur->fetch();
?>

    <h2><?= $realisateur['id_realisateur']?></h2> <!-- Output some content -->

<?php

echo "<p>Detail Realisateur :<p>";

echo "<p>" . $realisateur["nomCompletR"] . "</p>";


?>
    



<?php

    $title = "Detail Film";
    $content = ob_get_clean(); //Capture the output buffer and end buffering 
    require "views/template.php"; //ca fait le lien avec template

?>
