<?php
defined("ROOT_ACCESS") or die();
$utilisateur = unserialize($_SESSION['user']);
if ($utilisateur->GetAutorite() == 0) {
    die();
}
$user = serialize($_SESSION['user']);

include_once (__DIR__ . '../../../modeles/authentification/authentification.php');

if(isset($_POST['idCursus'])) {
    $listEleves = GetUsersFromCursus($_POST['idCursus']);
    // TODO : Faire le calcul de la moyenne générale d'un étudiant
    $autorite = $utilisateur->GetAutorite();
    include_once (__DIR__ . '../../../vues/ajax/visualisation_eleves.php');
}

if(isset($_POST['action']) && isset($_POST['mail'])) {
    if($_POST['action'] == "delete") {
        $mail = $_POST['mail'];
        DeleteUser($mail);
    }
}