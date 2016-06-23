<?php
global $nombreEtudiants;
defined("ROOT_ACCESS") or die();

include_once ('./modeles/authentification/utilisateur.class.php');
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    die();
}
else{
    $user = unserialize($_SESSION['user']);
    if ($user->GetAutorite() == 0) {
        header('Location: accueil.php');
        die();
    }
}

// Inclusions des blocs du template du site
include_once (__DIR__ . '../../modeles/sqlConnection.php');
include_once ('./modeles/consultation/consultation.php');
include_once ('./controleurs/tab_request.php');
include_once (__DIR__ . '../../vues/menu.php');

// Importation de la partie d'upload
if (isset($_FILES['fichier_eleves']) && !empty($_POST['idCursusUpload'])) {
    $extension = strrchr($_FILES['fichier_eleves']['name'], '.');
    if ($extension != ".csv") {
        $erreur_upload = 1;
        include_once('./vues/admin/error.php');
    } else {
        $result = ParseFichierEtudiants($_POST['idCursusUpload'], ";");
        if ($result){
            $code_upload = 1;
            include_once('./vues/admin/congratulations.php');
        }
    }
}

// Insertion de la partie contenu de la visualisation
if(isset($_GET['id'])) {
    $user_vue = GetUser($_GET['id']);
    if(isset($user_vue)) {
        $_SESSION['user_vue'] = serialize($user_vue); // pour que l'AJAX ne perde pas
        // On teste si c'est un admin qui visualise un étudiant
        $idEtudiant = GetEtudiant($user_vue)->GetId();

        // On incrémente le compteur pour cet étudiant
        IncrementConsultation($user->GetMail(),$idEtudiant);
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

function ParseFichierEtudiants($idCursus, $delimiter) {
    if(!isset($_FILES['fichier_eleves'])) {
        $erreur_upload = 3;
        include_once('./vues/admin/error.php');
        return false;
    }

    if (($handle = fopen($_FILES['fichier_eleves']['tmp_name'], "r")) !== FALSE) {
        $header = fgetcsv($handle, 1000, $delimiter);
        if (count($header) <= 1) {
            if ($delimiter == ',') {
                $erreur_upload = 2;
                include_once('./vues/admin/error.php');
                return false;
            } else {
                fclose($handle);
                return ParseFichierEtudiants($idCursus, ','); // On retente avec l'autre delimiter
            }
        }
        $indexIDEtudiant = -1;
        $indexPrenom = -1;
        $indexNom =-1;
        foreach ($header as $i => $category) {
            if ($category == 'id.Apprenant')
                $indexIDEtudiant = $i;
            elseif ($category == 'Prénom.Apprenant')
                $indexPrenom = $i;
            elseif ($category == 'Nom.Apprenant')
                $indexNom = $i;
        }
        global $nombreEtudiants;
        $nombreEtudiants=0;
        while (($data = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
            $mail = GetMailFromNomPrenom($data[$indexNom],$data[$indexPrenom]);
            if(!empty($mail)) {
                InsertEtudiant($idCursus, $data[$indexIDEtudiant], $data[$indexNom], $data[$indexPrenom], $mail);
                $nombreEtudiants++;
            }
        }
        fclose($handle);
        return true;
    }
    $erreur_upload = 3;
    include_once('./vues/admin/error.php');
    return false;
}

function GetMailFromNomPrenom($nom, $prenom) {
    $ndd_mail = "isen-lille.fr";
    if(!empty($nom) && !empty($prenom)) {
        $mail = $prenom . "." . $nom . '@' . $ndd_mail;
        $mail = str_replace(" ", "_", $mail);
        $mail = str_replace("'", "_", $mail);
        return strtolower($mail);
    }
    else {
        return "";
    }
}