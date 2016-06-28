<?php
defined("ROOT_ACCESS") or die();
include_once('modeles/sqlConnection.php');
include_once ('./modeles/authentification/utilisateur.class.php');

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    die(); }
else {
    $user = unserialize($_SESSION['user']);
    if ($user->GetAutorite() != 1) {
        header('Location: accueil.php');
        die();
    }

    if (isset($_GET['idCursusSauvegarde'])){
        if(is_numeric($_GET['idCursusSauvegarde'])){
            ExportDB($_GET['idCursusSauvegarde']);
            die();
        }
    }
    if (isset($_POST['idCursusCopie'])){
        if(is_numeric($_POST['idCursusCopie'])){
            CopyCursus($_POST['idCursusCopie']);
        }
    }

    if (isset($_FILES['fichier_db']))
        ImportDB();

	include_once ('./vues/menu.php');
	include_once ('./vues/admin/organisation_etudes.php');

	// On importe les blocs "modals" pour gérer les études
	include_once ('./vues/admin/blocs_insertion.php');
	include_once ('./vues/admin/blocs_modification.php');
	include_once ('./vues/admin/blocs_suppression.php');

	include_once ('./vues/footer.php');
}
function ImportDB()
{
    if (($handle = fopen($_FILES['fichier_db']['tmp_name'], "r")) !== FALSE) {
        $i=0;
        while (($data = fgetcsv($handle, 1000, ";")) != FALSE) {
            if($data[0]=="cursus"){ImportCursus($handle);}
            elseif($data[0]=="competence"){ImportCompetence($handle);}
            elseif($data[0]=="cours"){ImportCours($handle);}
            elseif($data[0]=="evaluation"){ImportEvaluation($handle);}
            elseif($data[0]=="type_eval"){ImportTypeEval($handle);}
            elseif($data[0]=="epreuve"){ImportEpreuve($handle);}
            elseif($data[0]=="etudiantnote"){ImportEtudiantNote($handle);}
        }
        fclose($handle);
    }
    return;
}

function ImportCursus($handle)
{
    $count = fgetcsv($handle, 1000, ";")[0];
    for ($i = 0; $i < $count; $i++) {
        $data = fgetcsv($handle, 1000, ";");
        InsertCursusFull($data);
    }
    fgetcsv($handle, 1000, ";");
}
function ImportCompetence($handle)
{
    $count = fgetcsv($handle, 1000, ";")[0];
    for ($i = 0; $i < $count; $i++) {
        $data = fgetcsv($handle, 1000, ";");
        InsertCompetenceFull($data);
    }
    fgetcsv($handle, 1000, ";");
}
function ImportCours($handle)
{
    $count = fgetcsv($handle, 1000, ";")[0];
    for ($i = 0; $i < $count; $i++) {
        $data = fgetcsv($handle, 1000, ";");
        InsertCoursFull($data);
    }
    fgetcsv($handle, 1000, ";");
}
function ImportEvaluation($handle)
{
    $count = fgetcsv($handle, 1000, ";")[0];
    for ($i = 0; $i < $count; $i++) {
        $data = fgetcsv($handle, 1000, ";");
        InsertEvaluationFull($data);
    }
    fgetcsv($handle, 1000, ";");
}
function ImportTypeEval($handle)
{
    $count = fgetcsv($handle, 1000, ";")[0];
    for ($i = 0; $i < $count; $i++) {
        $data = fgetcsv($handle, 1000, ";");
        InsertTypeEvalFull($data);
    }
    fgetcsv($handle, 1000, ";");
}
function ImportEpreuve($handle)
{
    $count = fgetcsv($handle, 1000, ";")[0];
    for ($i = 0; $i < $count; $i++) {
        $data = fgetcsv($handle, 1000, ";");
        InsertEpreuveFull($data);
    }
    fgetcsv($handle, 1000, ";");
}
function ImportEtudiantNote($handle)
{
    $count = fgetcsv($handle, 1000, ";")[0];
    for ($i = 0; $i < $count; $i++) {
        $data = fgetcsv($handle, 1000, ";");
        InsertEtudiantNoteFull($data);
    }
    fgetcsv($handle, 1000, ";");
}