<?php
defined("ROOT_ACCESS") or die();

// On teste si c'est un admin qui visualise un étudiant
if(isset($_SESSION['user_vue']) && $user->GetAutorite() != 0) {
    $user_vue = unserialize($_SESSION['user_vue']);
    if (isset($user_vue)) {
        $etudiant = GetEtudiant($user_vue);
    }
}
else {
    $etudiant = GetEtudiant($user);
}

$cursus = $etudiant->GetCursus();
if(!isset($cursus))
    die();

$idEtudiant = $etudiant->GetId();
$competenceList = GetCompetenceListFromCursus($cursus->GetId());

if(isset($_POST['button'])) {
    if($_POST['button'] == "tableaux") {
        include_once __DIR__ . '../../../vues/ajax/tableaux_bloc.php';
    }
}
if(isset($_POST['button'])) {
    if($_POST['button'] == "histog")
        include_once __DIR__ . '../../../vues/ajax/histo_bloc.php';
}
if(isset($_POST['button'])) {
    if($_POST['button'] == "batons") {
        include_once __DIR__ . '../../../vues/ajax/batons_bloc.php';
    }
}