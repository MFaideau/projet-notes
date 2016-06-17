<?php
define("ROOT_ACCESS",true);
session_start();

// On fait les vérifications nécessaires pour protéger le panneau admin des requêtes AJAX
if (!isset($_SESSION['user'])) {
    die();
}

include_once __DIR__ . '../../modeles/sqlConnection.php';
include_once __DIR__ . '../../modeles/authentification/utilisateur.class.php';
include_once __DIR__ . '../../modeles/cursus/cursus.php';
include_once __DIR__ . '../../modeles/type_evaluation/typeeval.php';

$user = unserialize($_SESSION['user']);
include_once __DIR__ . '../../controleurs/tab_request.php';

if(isset($_POST['idCompetence'])) {
    $idCompetence = $_POST['idCompetence'];
    $credits_competence = GetCreditsFromCompetence($_POST['idCompetence']);
    $coursList = GetCoursListFromCompetence($_POST['idCompetence']);
    $idEtudiant = GetEtudiant($user)->GetId();
    include_once __DIR__ . '../../vues/ajax/navigation/tableaux_cours_bloc.php';
}

if(isset($_POST['idCours'])) {
    $epreuvesList =GetEpreuveListFromCours($_POST['idCours']);
    $credits_cours = GetCoursById($_POST['idCours'])->GetCredits();
    $competence = GetCompetenceFromCours($_POST['idCours']);
    $idEtudiant = GetEtudiant($user)->GetId();
    include_once __DIR__ . '../../vues/ajax/navigation/tableaux_epreuves_bloc.php';
}
