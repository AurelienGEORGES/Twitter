<?php

namespace App\View;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

use App\database\Database;

//CONNEXION A LA BASE DE DONNEES
$db = new Database();
$db->Connect();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet Twitter | Status</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body>

    <main>

        <header class="header">

            <div>
                <img src="CSS/Projet_Twitter2.jpeg" />
            </div>
            <div>
                <h1>Page Comments</h1>
            </div>
            <div class="marginTop">
                <a class="classBtn" id="decalageBtn" href="http://localhost/Eval_PHP_Twitter/">Revenir à la page d'accueil</a>
            </div>

        </header>

        <section class="backNouveauComment">

            <h2>Ajout d'un nouveau commentaire</h2>

            <!--FORMULAIRE D'AJOUT D'UN COMMENTAIRE-->
            <form action="?page=createComment" method="post" class="FormAlignCenter">
                <input name="auteurComment" type="text" placeholder="auteur" maxlength="255" required />
                <br />
                <input name="contenuComment" type="text" placeholder="contenu du commentaire" maxlength="255" required />
                <br />
                <input type="hidden" name="idStatus" value="<?= $status->getId() ?>" />
                <br />
                <input type="submit" value="Postez votre commentaire" />
            </form>

        </section>

        <h2>Voici le status</h2>

        <!--AFFICHAGE DU STATUS SELECTIONNE-->

        <h3><?= 'auteur = ' . $status->getAuteur_Status() . ' ; ', 'titre = ' . $status->getTitre_Status() . ' ; ', 'content = ' . $status->getContent_Status() . ' ; ', 'date = ' . $status->getDate_Status(); ?></h3>

        <h2>Voici ses commentaires</h2>

        <!--BOUCLE POUR AFFICHER LES COMMENTAIRES DU STATUS-->

        <?php foreach ($comments as $comment) : ?>

            <h3><?= 'auteur = ' . $comment->getAuteur_Comment() . ' ; ', 'content = ' . $comment->getContent_Comment() . ' ; ', 'date = ' . $comment->getDate_Comment(); ?></h3>

        <?php endforeach ?>

    </main>

</body>

</html>