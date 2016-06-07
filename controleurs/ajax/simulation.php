<?php

if (isset($_POST['idCompetence'])) {
    $coursList = GetCoursListFromCompetence($_POST['idCompetence']);
    include_once __DIR__ . '../../../vues/simulation_cours.php';
}
if (isset($_POST['idCours'])) {

}

if(isset($_POST['idEpreuve']) && isset($_POST['note']))
{
    // On insère dans la base de données la nouvelle note
    // TODO
}