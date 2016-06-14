<?php

include_once('modeles/sqlConnection.php');
include_once ('./modeles/authentification/utilisateur.class.php');

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    die(); }
else {
    $user = unserialize($_SESSION['user']);
    if ($user->GetAutorite() != 1) {
        header('Location: accueil.php');
        die();
    }
    $usersList = GetAdmins();
    include_once ('./vues/menu.php');
    include_once ('./vues/gestion_comptes.php');
    include_once ('./vues/footer.php');
}