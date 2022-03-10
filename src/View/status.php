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

<!--PAGE D AFFICHAGE DES STATUS-->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Network</title>
    <link rel="stylesheet" href="CSS/style.css">

</head>

<body>

    <main>
        <!--HEADER DU RESEAU SOCIAL-->
        <header class="header">

            <div>
                <img src="CSS/Projet_Twitter.jpeg" />
            </div>

            <div>
                <h1 id="CustomTitle">Projet Twitter</h1>
            </div>
            <div>
            <div class="marginTop">
                <a class="classBtn" href="?page=triAscendant">Tri ascendant</a>
            </div>
            <div>
                <a class="classBtn" href="?page=triDescendant">Tri descendant</a>
            </div>
            </div>

            <!--FORMULAIRE POUR FAIRE UN TRI PAR TITRE-->
            <form action="?page=triTitre" method="post">
                <input name="rechercheTitre" type="text" placeholder="rentrez le titre recherché" required />
                <br />
                <input type="submit" value="recherche par titre"></input>
            </form>

            <!--FORMULAIRE POUR FAIRE UN TRI PAR HASH TAG-->
            <form action="?page=triHashTag" method="post">
                <input name="rechercheHashTag" type="text" placeholder="rentrez le hashtap souhaité" required />
                <br />
                <input type="submit" value="recherche par #"></input>
            </form>

        </header>

        <!--FORMULAIRE D'AJOUT D'UN STATUS-->

        <section class="backNouveauStatus">

        <h2>Ajout d'un nouveau status</h2>
        
        <form action="?page=createStatus" method="post" class="FormAlignCenter">    
            <input name="auteurStatus" type="text" placeholder="auteur" maxlength="255" required />
            <br />
            <input name="titreStatus" type="text" placeholder="titre du status" maxlength="255" required />
            <br />
            <input name="contenuStatus" type="textarea" placeholder="contenu du status" maxlength="255" required />
            <br />
            <input type="submit" value="Postez votre status"></input>
        </form>

        </section>

        <!--TITRE DE PRESENTATION DES STATUS-->

        <section class="backStatus">

        <h2>Voici les status</h2>

        <!--BOUCLE POUR AFFICHER LES STATUT-->
        <?php foreach ($status as $statu) : ?>

            <h3><a href="?page=comment&id=<?=$statu->getId()?>" class="hoverEffect"><?= 'auteur = ' . $statu->getAuteur_Status() . ' ; ', 'titre = ' . $statu->getTitre_Status() . ' ; ', 'content = ' . $statu->getContent_Status() . ' ; ', 'date = ' . $statu->getDate_Status(); ?></a></h3>
            
        <?php endforeach ?>

        </section>

    </main>

</body>

</html>