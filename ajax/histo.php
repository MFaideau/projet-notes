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

$user = unserialize($_SESSION['user']);

// TODO : faire un tri dans le dossier ajax et le mettre dans le controlleur

include_once __DIR__ . '../../controleurs/tab_request.php';
include_once __DIR__ . '../../modeles/etudiantnote/etudiantnote.php';

if(isset($_POST['idCompetence'])) {
    $credits_competence = GetCreditsFromCompetence($_POST['idCompetence']);
    $coursList = GetCoursListFromCompetence($_POST['idCompetence']);
    if(isset($_POST['type'])) {
        if($_POST['type'] == "histo_hor")
            include_once __DIR__ . '../../vues/ajax/navigation/histo_cours_bloc.php';
        if($_POST['type'] == "histo_vert")
            include_once __DIR__ . '../../vues/ajax/navigation/histo_commun_cours.php';
    }
}

if(isset($_POST['idCours'])) {
    $epreuvesList = GetEpreuveListFromCours($_POST['idCours']);
    $credits_cours = GetCoursById($_POST['idCours'])->GetCredits();
    $competence = GetCompetenceFromCours($_POST['idCours']);
    if (isset($_POST['type'])) {
        if ($_POST['type'] == "histo_cours_hor")
            include_once __DIR__ . '../../vues/ajax/navigation/histo_epreuves_bloc.php';
        if ($_POST['type'] == "histo_cours_vert")
            include_once __DIR__ . '../../vues/ajax/navigation/histo_commun_epreuves.php';
    }
}
