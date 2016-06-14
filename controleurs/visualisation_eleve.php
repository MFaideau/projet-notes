<?php

// Inclusions des blocs du template du site
include_once (__DIR__ . '../../modeles/sqlConnection.php');
include_once ('./modeles/authentification/utilisateur.class.php');
include_once ('./modeles/consultation/consultation.php');
$user = unserialize($_SESSION['user']);
include_once (__DIR__ . '../../vues/menu.php');

// Insertion de la partie contenu de la visualisation
if(isset($_GET['id'])) {
    $mail = $_GET['id'];
    $user_vue = GetUser($mail);
    if(isset($user_vue)) {
        // On incrémente le compteur pour cet étudiant
        IncrementConsultation($user->GetMail(),GetEtudiant($user_vue)->GetId());
	    // Insertion du menu uniquement lorsque l'on est en mode "étudiant"
		include_once (__DIR__ . '/../vues/menu_rapide.php');
   		include_once(__DIR__ . '/releve_onglet.php');
	}
}
else {
    if ($user->GetAutorite() != 0)
        include_once(__DIR__ . '../../vues/visualisation_eleve.php');
}

// Insertion du footer pour les scripts JS (jQuery)
include_once (__DIR__ . '../../vues/footer.php');

