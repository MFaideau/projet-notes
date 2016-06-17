<?php
defined("ROOT_ACCESS") or die();
$utilisateur = unserialize($_SESSION['user']);
if ($utilisateur->GetAutorite() == 0) {
    die();
}
$user = unserialize($_SESSION['user']);

include_once (__DIR__ . '../../../modeles/authentification/authentification.php');
include_once (__DIR__ . '../../../controleurs/tab_request.php');

if(isset($_POST['idCursus'])) {
    $listEleves = GetUsersFromCursus($_POST['idCursus']);
    $autorite = $utilisateur->GetAutorite();
    include_once (__DIR__ . '../../../vues/ajax/visualisation_eleves.php');
}

if(isset($_POST['action']) && isset($_POST['mail'])) {
    if($_POST['action'] == "delete") {
        $mail = $_POST['mail'];
        DeleteUser($mail);
    }
}