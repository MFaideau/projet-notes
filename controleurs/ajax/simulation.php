<?php

if (isset($_POST['idCompetence'])) {
    $coursList = GetCoursListFromCompetence($_POST['idCompetence']);
    include_once __DIR__ . '../../../vues/simulation_cours.php';
}
if (isset($_POST['idCours'])) {
    
}