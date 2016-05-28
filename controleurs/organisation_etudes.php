<?php

include_once('modeles/sqlConnection.php');
include_once ('./modeles/authentification/utilisateur.class.php');

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    die(); }
else {
    $utilisateur = unserialize($_SESSION['user']);
    if ($utilisateur->GetAutorite() != 1) {
        header('Location: accueil.php');
        die();
    }
}

include_once ('./vues/menu.php');

include_once ('./vues/admin/organisation_etudes.php');

include_once ('./vues/footer.php');