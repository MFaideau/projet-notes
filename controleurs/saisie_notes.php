<?php
/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 26/05/2016
 * Time: 14:06
 */
include_once ('./modeles/authentification/utilisateur.class.php');

if (isset($_SESSION['user'])) {
    $utilisateur = unserialize($_SESSION['user']);
    // TODO : C'est 1 normalement, mais pour le test unitaire
    if ($utilisateur->GetAutorite() != 0) {
        header('Location: accueil.php');
        die();
    }
}

include_once('./vues/menu.php');

// On importe la vue
include_once('./vues/admin/saisie_notes.php');