<?php
define("ROOT_ACCESS",true);
session_start();

include_once __DIR__ . '../../modeles/sqlConnection.php';
include_once __DIR__ . '../../modeles/authentification/utilisateur.class.php';
include_once __DIR__ . '../../modeles/cursus/cursus.php';
include_once __DIR__ . '../../modeles/type_evaluation/typeeval.php';

// On fait les vérifications nécessaires pour protéger le panneau admin des requêtes AJAX
if (!isset($_SESSION['user'])) {
    die();
}

if(isset($_POST['idEtudiant']) && isset($_POST['idCursus']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail'])){
    InsertEtudiant($_POST['idCursus'],$_POST['idEtudiant'],$_POST['nom'],$_POST['prenom'],$_POST['mail']);
    die();
}

include_once __DIR__ . './../controleurs/ajax/visualisation_eleves.php';