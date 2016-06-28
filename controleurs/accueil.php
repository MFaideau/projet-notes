<?php
/**
 * @Auteur : Joël Guillem
 * @Desc : Accès à la vue de menu_accueil
 */
defined("ROOT_ACCESS") or die();
include_once('modeles/sqlConnection.php');
include_once('./modeles/authentification/utilisateur.class.php');
include_once('./modeles/consultation/consultation.php');

$user = unserialize($_SESSION['user']);
include_once('./controleurs/tab_request.php');

include_once("vues/menu.php");
if ($user->GetAutorite() == 0) {
    include_once("vues/menu_rapide.php");
}
if ($user->Getautorite() == 0) {
    $cursus = GetEtudiant($user)->GetCursus();
    if (isset($cursus)) {
        $competenceList = GetCompetenceListFromCursus($cursus->GetId());
        include_once("vues/accueil.php");
    }
} 
else {
    include_once('./controleurs/tab_request.php');
    $topConsult = GetTopConsultations($user->GetMail(),10);
    include_once("vues/liste_favori.php");
}

include_once("vues/footer.php");