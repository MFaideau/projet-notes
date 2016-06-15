<?php

include_once (__DIR__ . '../../modeles/sqlConnection.php');
include_once ('./modeles/authentification/utilisateur.class.php');

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    die(); }
else {
    $user = unserialize($_SESSION['user']);
    include_once ('./controleurs/tab_request.php');
    include_once(__DIR__ . '../../vues/menu.php');
    
    // On récupère d'abord la liste des compétences par défaut (de l'étudiant)
    $cursus = GetEtudiant($user)->GetCursus();
    if (isset($cursus)) {
        $competences = GetCompetenceListFromCursus($cursus->GetId());
        include_once(__DIR__ . '../../vues/simulation_competences.php');
    }

    include_once(__DIR__ . '../../vues/footer.php');
}