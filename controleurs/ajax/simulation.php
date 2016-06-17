<?php
defined("ROOT_ACCESS") or die();
if (isset($_POST['idCompetence'])) {
    $coursList = GetCoursListFromCompetence($_POST['idCompetence']);
    include_once __DIR__ . '../../../controleurs/tab_request.php';
    include_once __DIR__ . '../../../vues/simulation_cours.php';
}
if (isset($_POST['idCours'])) {
    $epreuvesList = GetEpreuveListFromCours($_POST['idCours']);
    include_once __DIR__ . '../../../vues/simulation_epreuves.php';
}

if(isset($_POST['idEpreuve']) && isset($_POST['note']))
{
    $note = $_POST['note'];
    if($note < 0 && $note > 20) {
        die();
    }
    // On insère dans la base de données la nouvelle note
    // TODO
}