<?php
defined("ROOT_ACCESS") or die();
$user = unserialize($_SESSION['user']);
if ($user->GetAutorite() == 0) {
    die();
}

include_once (__DIR__ . '../../../modeles/authentification/authentification.php');
include_once (__DIR__ . '../../../controleurs/tab_request.php');
include_once (__DIR__ . '../../../modeles/consultation/consultation.php');

if(isset($_POST['idEtudiant']) && isset($_POST['idCursus']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail'])){
    InsertEtudiant($_POST['idCursus'],$_POST['idEtudiant'],$_POST['nom'],$_POST['prenom'],$_POST['mail']);
    die();
}

if(isset($_POST['idCursus'])) {
    $listEleves = GetUsersFromCursus($_POST['idCursus']);
    $autorite = $user->GetAutorite();
    include_once (__DIR__ . '../../../vues/ajax/visualisation_eleves.php');
}

if(isset($_POST['action']) && isset($_POST['mail'])) {
    if($_POST['action'] == "delete") {
        $mail = $_POST['mail'];
        DeleteUser($mail);
    }
}

if(isset($_POST['action'])) {
    if($_POST['action'] == "deleteTopConsult") {
        // il ne peut supprimer que sa propre liste de consultation
        DeleteTopConsultation($user->GetMail());
    }
}