<?php
defined("ROOT_ACCESS") or die();
include_once (__DIR__ . '../../modeles/sqlConnection.php');
include_once ('./modeles/authentification/utilisateur.class.php');

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    die(); }
else {
    $user = unserialize($_SESSION['user']);
    if(isset($user)) {
        $etudiant = GetEtudiant($user);
        if (isset($_SESSION['user_vue'])) {
            $user_vue = unserialize($_SESSION['user_vue']);
            if(isset($user_vue))
                $etudiant = GetEtudiant($user_vue);
        }
        $idEtudiant = $etudiant->GetId();
        include_once('./controleurs/tab_request.php');
        include_once(__DIR__ . '../../vues/menu.php');
        include_once(__DIR__ . '../../vues/menu_rapide.php');

        // On récupère l'étudiant à partir de l'utilisateur, plus pratique (- de requetes!)
        if (isset($etudiant)) {
            $cursus = $etudiant->GetCursus();
            $competences = GetCompetenceListFromCursus($cursus->GetId());
            include_once(__DIR__ . '../../vues/simulation_competences.php');
        }
    }

    include_once(__DIR__ . '../../vues/footer.php');
}