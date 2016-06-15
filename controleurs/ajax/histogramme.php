<?php

// Les fonctions utilisées pour le calcul des moyennes se trouve dans ce fichier.
include_once (__DIR__ . '../../../controleurs/tab_request.php');

// TODO : Adapter pour chaque compétence
$idCompetence = 1;
$tabTest = GetTabNotesEtudiantsFromCompetence($idCompetence);
$varTab = GetVarTabHistoBatons($tabTest);

echo json_encode($varTab);