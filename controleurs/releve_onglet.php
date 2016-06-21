<?php
defined("ROOT_ACCESS") or die();
include_once (__DIR__ . '../../modeles/sqlConnection.php');
include_once('modeles/sqlConnection.php');
include_once ('./modeles/authentification/utilisateur.class.php');

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    die(); }
else {
    $user = unserialize($_SESSION['user']);
    $etudiant = GetEtudiant($user);
    if(isset($user_vue)) {
        $etudiant = GetEtudiant($user_vue);
    }
    $idEtudiant = $etudiant->GetId();
    $cursus = $etudiant->GetCursus();
    include_once __DIR__ . '../../controleurs/tab_request.php';
    include_once(__DIR__ . '../../vues/menu.php');
    include_once(__DIR__ . '../../vues/menu_rapide.php');

    if (isset($cursus)) {
        $competenceList = GetCompetenceListFromCursus($cursus->GetId());
        include_once(__DIR__ . '../../vues/ajax/tableaux_bloc.php');
    }
    include_once(__DIR__ . '../../vues/footer.php');
}