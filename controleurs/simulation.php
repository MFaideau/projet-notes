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
    
    // On récupère l'étudiant à partir de l'utilisateur, plus pratique (- de requetes!)
    $etudiant = GetEtudiant($user);
    if (isset($etudiant)) {
        $cursus = $etudiant->GetCursus();
        $competences = GetCompetenceListFromCursus($cursus->GetId());
        $idEtudiant = $etudiant->GetId();
        include_once(__DIR__ . '../../vues/simulation_competences.php');
    }

    include_once(__DIR__ . '../../vues/footer.php');
}