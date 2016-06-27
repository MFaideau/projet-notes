<?php
defined("ROOT_ACCESS") or die();
include_once('modeles/sqlConnection.php');
include_once('./modeles/authentification/utilisateur.class.php');

$nombreNotes = 0;
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    die();
} else {
    $user = unserialize($_SESSION['user']);
    if ($user->GetAutorite() == 0) {
        header('Location: accueil.php');
        die();
    }
    include_once('./vues/menu.php');
    include_once('tab_request.php');
    // Si on a reçu le fichier de notes, on le traite sinon on affiche le formulaire
    if (isset($_FILES['fichier_notes']) && !empty($_POST['idEpreuveUpload'])) {
        $extension = strrchr($_FILES['fichier_notes']['name'], '.');
        if ($extension != ".csv") {
            $erreur_upload = 1;
            include_once('./vues/admin/error.php');
        } else {
            $result = AjouterNotes($_POST['idEpreuveUpload'], ';');
            if ($result){
                $code_upload = 1;
                include_once('./vues/admin/congratulations.php');
            }
        }
    }
    include_once('./vues/admin/saisie_notes.php');
    include_once('./vues/footer.php');
}

function AjouterNotes($idEpreuve, $delimiter)
{
    if (($handle = fopen($_FILES['fichier_notes']['tmp_name'], "r")) !== FALSE) {
        $header = fgetcsv($handle, 1000, $delimiter);
        if (count($header) <= 1) {
            if ($delimiter == ',') {
                $erreur_upload = 2;
                include_once('./vues/admin/error.php');
                return false;
            } else {
                fclose($handle);
                return AjouterNotes($idEpreuve, ',');
            }
        }
        $indexIDEtudiant = -1;
        $indexNote = -1;
        $indexMotifAbsence = -1;
        foreach ($header as $i => $category) {
            if ($category == 'id.Apprenant')
                $indexIDEtudiant = $i;
            elseif ($category == 'Note numérique')
                $indexNote = $i;
            elseif ($category == "Motif d absence")
                $indexMotifAbsence = $i;
        }
        global $nombreNotes;
        $nombreNotes=0;
        global $nombreAbsencesExcusees;
        $nombreAbsencesExcusees = 0;
        global $nombreAbsencesNonExcusees;
        $nombreAbsencesNonExcusees = 0;
        $idCursus=GetCursusIdFromEpreuveId($idEpreuve);
        $idCompetence=GetCompetenceIdFromEpreuveId($idEpreuve);
        $idCours = GetCoursIdFromEpreuveId($idEpreuve);
        while (($data = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
            $note = str_replace(',','.',$data[$indexNote]);
            $motifAbsence = $data[$indexMotifAbsence];
            $absence = 0; // par défaut, il est présent
            if(!empty($motifAbsence)) {
                if ($motifAbsence == "NON_EXCUSE") {
                    $note = 0;
                    $absence = 2;
                    $nombreAbsencesNonExcusees++;
                }
                else {
                    $note = -1;
                    $absence = 1;
                    $nombreAbsencesExcusees++;
                }
            }
            AddEtudiantNote($idEpreuve, $data[$indexIDEtudiant], $note, $absence);
            UpdateMoyenneEtudiant($data[$indexIDEtudiant],$idCursus,$idCompetence,$idCours);
            $nombreNotes++;
        }
        fclose($handle);
        return true;
    }
    $erreur_upload = 3;
    include_once('./vues/admin/error.php');
    return false;
}

function UpdateMoyenneEtudiant($idEtudiant,$idCursus,$idCompetence,$idCours){
    //InsertMoyenneCompetence($idCompetence);
    //InsertMoyenneCursus($idCursus);
    //InsertMoyenneCours($idCours);
    UpdateMoyenneCursusEtudiant($idCursus, $idEtudiant, GetMoyenneFromCursus($idCursus, $idEtudiant));
    UpdateMoyenneCompetenceEtudiant($idCompetence, $idEtudiant, GetMoyenneFromCompetence($idCompetence, $idEtudiant));
    UpdateMoyenneCoursEtudiant($idCours, $idEtudiant, GetMoyenneFromCours($idCours, $idEtudiant));
    return;
}