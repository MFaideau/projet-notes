<?php
defined("ROOT_ACCESS") or die();

if(isset($_POST['idCompetence'])) {
    $idCompetence = $_POST['idCompetence'];
    $credits_competence = GetCreditsFromCompetence($idCompetence);
    $coursList = GetCoursListFromCompetence($idCompetence);
    include_once __DIR__ . '/../../vues/ajax/navigation/tableaux_cours_bloc.php';
}

if(isset($_POST['idCours'])) {
    $epreuvesList = GetEpreuveListFromCours($_POST['idCours']);
    $cours = GetCoursById($_POST['idCours']);
    $credits_cours = $cours->GetCredits();
    $competence = GetCompetenceFromCours($_POST['idCours']);
    include_once __DIR__ . '/../../vues/ajax/navigation/tableaux_epreuves_bloc.php';
}
