<?php
/*
* @ Auteur: B. Landais
* @ Description : Une fois que le compte est connecté, on peut le rediriger vers la page d'accueil (celle-ci!).
*/
define("ROOT_ACCESS",true);
session_start();
// Si le compte n'est pas connecté, on le redirige vers la page d'accueil
if(!isset($_SESSION['user'])) {
    header('Location: index.php?erreur_connexion=1');
    die("Pas connecté");
}

include_once('modeles/sqlConnection.php');
include_once("controleurs/accueil.php");

?>