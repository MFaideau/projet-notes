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
// On gère le cas où c'est un admin qui visualise un étudiant
if(isset($_SESSION['user_vue']) && $user->GetAutorite() != 0) {
    $user_vue = unserialize($_SESSION['user_vue']);
    if (isset($user_vue))
        $etudiant = GetEtudiant($user_vue);
}
else
    $etudiant = GetEtudiant($user);

// TODO : faire un tri dans le dossier ajax et le mettre dans le controleur
$cursus = $etudiant->GetCursus();
$idEtudiant = $etudiant->GetId();

if(!isset($cursus))
    die();

include_once __DIR__ . '../../controleurs/tab_request.php';
include_once __DIR__ . '../../modeles/etudiantnote/etudiantnote.php';

if(isset($_POST['idCompetence'])) {
    $idCompetence = $_POST['idCompetence'];
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
    $idCours = $_POST['idCours'];
    $credits_cours = GetCoursById($idCours)->GetCredits();
    $epreuvesList = GetEpreuveListFromCours($idCours);
    $competence = GetCompetenceFromCours($idCours);
    if (isset($_POST['type'])) {
        if ($_POST['type'] == "histo_cours_hor")
            include_once __DIR__ . '../../vues/ajax/navigation/histo_epreuves_bloc.php';
        if ($_POST['type'] == "histo_cours_vert") {
            include_once __DIR__ . '../../vues/ajax/navigation/histo_commun_epreuves.php';
        }
    }
}