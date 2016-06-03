<?php

$utilisateur = unserialize($_SESSION['user']);
if ($utilisateur->GetAutorite() != 1) {
    die();
}

$user = serialize($_SESSION['user']);

if(isset($_POST['idCursus'])) {
    $listEleves = GetUsersFromCursus($_POST['idCursus']);
    // TODO : Faire le calcul de la moyenne générale d'un étudiant
    include_once (__DIR__ . '../../../vues/ajax/visualisation_eleves.php');
}