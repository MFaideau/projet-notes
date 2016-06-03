<?php

include_once('modeles/sqlConnection.php');
include_once ('./modeles/authentification/utilisateur.class.php');

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    die(); }
else {
    $utilisateur = unserialize($_SESSION['user']);
    if ($utilisateur->GetAutorite() != 1) {
        header('Location: accueil.php');
        die();
    }
}

include_once('./vues/menu.php');

// Si on a reçu le fichier de notes, on le traite sinon on affiche le formulaire
if(isset($_FILES['fichier_notes'])) {
    $extension = strrchr($_FILES['fichier_notes']['name'], '.');
    if ($extension != ".csv") {
        $erreur_upload = 1;
        include_once('./vues/admin/error.php');
    } else {
        echo "Fichier de notes bien importé!";
    }
}
include_once('./vues/admin/saisie_notes.php');


include_once('./vues/footer.php');