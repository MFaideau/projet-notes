<?php

session_start();
// Si le compte n'est pas connecté, on le redirige vers la page d'accueil
if(!isset($_SESSION['user'])) {
    header('Location: index.php?erreur_connexion=2');
    die("Pas connecté");
}
include_once ("controleurs/simulation.php");