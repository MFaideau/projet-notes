<?php
include_once('modeles/sqlConnection.php');
include_once('./modeles/authentification/utilisateur.class.php');

$nombreNotes = 0;
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    die();
} else {
    $user = unserialize($_SESSION['user']);
    if ($user->GetAutorite() != 1) {
        header('Location: accueil.php');
        die();
    }
    include_once('./vues/menu.php');

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
        // $indexAbsence =-1;
        foreach ($header as $i => $category) {
            if ($category == 'id.Apprenant')
                $indexIDEtudiant = $i;
            elseif ($category == 'Note numérique')
                $indexNote = $i;
        }
        global $nombreNotes;
        $nombreNotes=0;
        while (($data = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
            AddEtudiantNote($idEpreuve, $data[$indexIDEtudiant], $data[$indexNote], 0);
            $nombreNotes++;
        }
        fclose($handle);
        return true;
    }
}