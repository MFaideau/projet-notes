<?php
/**
 * @Auteur : Joël Guillem
 * @Desc : Accès à la vue de menu_accueil
 */

include_once('./modeles/authentification/utilisateur.class.php');
$user = unserialize($_SESSION['user']);

include_once("vues/menu.php");
if ($user->GetAutorite() == 0) {
    include_once("vues/menu_rapide.php");
}
if ($user->Getautorite() == 0) {
    include_once("vues/accueil.php");
} else {
    $listEleves = GetElevestop10();
    include_once("vues/liste_favori.php");
}
include_once("vues/footer.php");