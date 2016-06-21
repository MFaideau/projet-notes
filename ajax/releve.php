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

// On gère le cas où c'est un admin qui visualise un étudiant
if(isset($_SESSION['user_vue'])) {
    $user_vue = unserialize($_SESSION['user_vue']);
    if (isset($user_vue))
        $idEtudiant = GetEtudiant($user_vue)->GetId();
}
else
    $idEtudiant = GetEtudiant($user)->GetId();

if(isset($_POST['idCompetence'])) {
    $idCompetence = $_POST['idCompetence'];
    $credits_competence = GetCreditsFromCompetence($idCompetence);
    $coursList = GetCoursListFromCompetence($idCompetence);
    include_once __DIR__ . '../../vues/ajax/navigation/tableaux_cours_bloc.php';
}

if(isset($_POST['idCours'])) {
    $epreuvesList = GetEpreuveListFromCours($_POST['idCours']);
    $cours = GetCoursById($_POST['idCours']);
    $credits_cours = $cours->GetCredits();
    $competence = GetCompetenceFromCours($_POST['idCours']);
    include_once __DIR__ . '../../vues/ajax/navigation/tableaux_epreuves_bloc.php';
}
