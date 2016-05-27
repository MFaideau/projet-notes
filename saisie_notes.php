<?php
/**
 * @Auteur : Baudouin Landais
 * @Description : Permet de récuperer le fichier de notes avec l'épreuve correspondante.
 */
session_start();
// Si le compte n'est pas connecté, on le redirige vers la page d'accueil
if(!isset($_SESSION['user'])) {
    header('Location: index.php?erreur_connexion=1');
    die("Pas connecté");
}

include_once('modeles/sqlConnection.php');

include_once('controleurs/saisie_notes.php');