<?php
defined("ROOT_ACCESS") or die();

/*
 * Ce fichier sert pour la partie étudiant à visualiser les blocs des histogrammes (partie dynamique)
 * Qui comprend : l'histogramme personnel et l'histogramme de la promo
 */

if(isset($_POST['idCompetence'])) {
    $idCompetence = $_POST['idCompetence'];
    $credits_competence = GetCreditsFromCompetence($idCompetence);
    $coursList = GetCoursListFromCompetence($idCompetence);
    if(isset($_POST['type'])) {
        if($_POST['type'] == "histo_hor")
            include_once __DIR__ . '/../../vues/ajax/navigation/histo_cours_bloc.php';
        if($_POST['type'] == "histo_vert")
            include_once __DIR__ . '/../../vues/ajax/navigation/histo_commun_cours.php';
    }
}

if(isset($_POST['idCours'])) {
    $idCours = $_POST['idCours'];
    $credits_cours = GetCoursById($idCours)->GetCredits();
    $epreuvesList = GetEpreuveListFromCours($idCours);
    $competence = GetCompetenceFromCours($idCours);
    if (isset($_POST['type'])) {
        if ($_POST['type'] == "histo_cours_hor")
            include_once __DIR__ . '/../../vues/ajax/navigation/histo_epreuves_bloc.php';
        if ($_POST['type'] == "histo_cours_vert") {
            include_once __DIR__ . '/../../vues/ajax/navigation/histo_commun_epreuves.php';
        }
    }
}