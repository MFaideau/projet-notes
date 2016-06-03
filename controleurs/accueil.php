<?php
/**
 * @Auteur : Joël Guillem
 * @Desc : Accès à la vue de menu_accueil
 */

include_once ('./modeles/authentification/utilisateur.class.php');
$user = unserialize($_SESSION['user']);

include_once ("vues/menu.php");
if($user->GetAutorite() != 1) {
	include_once ("vues/menu_rapide.php");
}
include_once ("vues/accueil.php");
include_once ("vues/footer.php");