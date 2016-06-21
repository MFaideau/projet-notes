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
    if (($handle = fopen($_FILES['export_bdd']['tmp_name'], "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            if($data=="cursus"){ImportCursus($handle);}
            elseif($data=="cursus"){ImportCursus($handle);}
        }
        fclose($handle);
        return true;
    }
    $erreur_upload = 3;
    include_once('./vues/admin/error.php');
    return false;
}

function ImportCursus($handle)
{
    global $bdd;
    $count = fgetcsv($handle, 1000, ";");
    for ($i = 0; $i < $count; $i++) {
        $data = fgetcsv($handle, 1000, ";");
        InsertCursusFull($data);
    }
}