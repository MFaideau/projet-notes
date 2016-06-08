<?php
// TODO : A nettoyer
include_once('modeles/sqlConnection.php');
include_once ('./modeles/authentification/utilisateur.class.php');

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    die(); }
else {

    $user = unserialize($_SESSION['user']);

    include_once(__DIR__ . '../../vues/menu.php');
    include_once(__DIR__ . '../../vues/simulateur_onglet.php');
    include_once(__DIR__ . '../../vues/footer.php');

}