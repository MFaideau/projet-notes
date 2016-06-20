<?php
/**
 * @Auteur: Baudouin LANDAIS
 * @Description: vue élève
 **/
define("ROOT_ACCESS",true);
session_start();

if(!isset($_SESSION['user'])) {
    header('Location: index.php?erreur_connexion=2');
    die("Pas connecté");
}

include_once (__DIR__ . '/controleurs/visualisation_eleve.php');

?>
