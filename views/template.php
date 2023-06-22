<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?></title>

    <!-- <script src="https://kit.fontawesome.com/a076e75914.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="public/css/style.css" />
</head>
<body>

    <header>
        <nav>
         <ul>
            <li><a href="index.php">Accueil</a></li>   
            <li><a href="index.php?action=listFilms">Films</a></li>
            <li><a href="index.php?action=listGenres">Genres</a></li>
            <li><a href="index.php?action=listRealisateurs">Realisateurs</a></li>
            <li><a href="index.php?action=listActors">Acteurs</a></li>
         </ul>

        </nav>
    </header>

 <main>

<?= $content ?>

 </main>   

<footer>
    <span>Ceci est un footer</span>
</footer>

</body>
</html>