<?php
defined("ROOT_ACCESS") or die();
include_once ('./modeles/authentification/utilisateur.class.php');
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    die();
}
else{
    $user = unserialize($_SESSION['user']);
    if ($user->GetAutorite() != 1) {
        header('Location: accueil.php');
        die();
    }
}

// Inclusions des blocs du template du site
include_once (__DIR__ . '../../modeles/sqlConnection.php');
include_once ('./modeles/consultation/consultation.php');
include_once ('./controleurs/tab_request.php');
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
else if (isset($_GET['listIdCursus'])) {
    $listIdCursus=$_GET['listIdCursus'];
    $listEleves = GetUsersFromCursus($listIdCursus);
    include_once (__DIR__ . '/../vues/admin/visualisation_lists/visualisation_list_cursus.php');
}
else if (isset($_GET['listIdCompetence'])) {
    $listIdCompetence=$_GET['listIdCompetence'];
    $listEleves = GetUsersFromCompetence($listIdCompetence);
    include_once (__DIR__ . '/../vues/admin/visualisation_lists/visualisation_list_competence.php');
}
else if (isset($_GET['listIdCours'])) {
    $listIdCours=$_GET['listIdCours'];
    $listEleves = GetUsersFromCours($listIdCours);
    include_once (__DIR__ . '/../vues/admin/visualisation_lists/visualisation_list_cours.php');
}
//else if (isset($_GET['listIdTypeEval'])) {
//    $listIdTypeEval=$_GET['listIdTypeEval'];
//    $listEleves = GetUsersFromTypeEval($listIdTypeEval);
//    include_once (__DIR__ . '/../vues/admin/visualisation_lists/visualisation_list_type_eval.php');
//}
else if (isset($_GET['listIdEpreuve'])) {
    $listIdEpreuve=$_GET['listIdEpreuve'];
    $listEleves = GetUsersFromEpreuve($listIdEpreuve);
    include_once (__DIR__ . '/../vues/admin/visualisation_lists/visualisation_list_epreuve.php');
}
else {
    if ($user->GetAutorite() != 0)
        include_once(__DIR__ . '../../vues/visualisation_eleve.php');
}

// Insertion du footer pour les scripts JS (jQuery)
include_once (__DIR__ . '../../vues/footer.php');

