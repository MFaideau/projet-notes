<?php

session_start();

include_once __DIR__ . '../../modeles/sqlConnection.php';
include_once __DIR__ . '../../modeles/authentification/utilisateur.class.php';
include_once __DIR__ . '../../modeles/cursus/cursus.php';
include_once __DIR__ . '../../modeles/type_evaluation/typeeval.php';

// On fait les vérifications nécessaires pour protéger le panneau admin des requêtes AJAX
if (!isset($_SESSION['user'])) {
    die();
}

if(isset($_POST['idCompetence'])) {
    $credits_competence = GetCreditsFromCompetence($_POST['idCompetence']);
    $coursList = GetCoursListFromCompetence($_POST['idCompetence']);
    include_once __DIR__ . '../../vues/ajax/navigation/tableaux_cours_bloc.php';
}

if(isset($_POST['idCours'])) {
    $epreuvesList =GetEpreuveListFromCours($_POST['idCours']);
    $credits_cours = GetCoursById($_POST['idCours'])->GetCredits();
    include_once __DIR__ . '../../vues/ajax/navigation/tableaux_epreuves_bloc.php';
}
