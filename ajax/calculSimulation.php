<?php

session_start();

include_once __DIR__ . '../../modeles/sqlConnection.php';
include_once __DIR__ . '../../modeles/authentification/utilisateur.class.php';
include_once __DIR__ . '../../modeles/cursus/cursus.php';
include_once __DIR__ . '../../modeles/type_evaluation/typeeval.php';
include_once __DIR__ . '../../modeles/cursus/cursus.php';

if (!isset($_SESSION['user'])) {
    die();
}

$user = unserialize($_SESSION['user']);

include_once __DIR__ . '../../controleurs/tab_request.php';

if (isset($_POST['action'])&&isset($_POST['idEpreuve'])&&isset($_POST['noteSimulee'])) {
    if($_POST['action'] == "changeNoteEpreuve") {
        $idEpreuve = $_POST['idEpreuve'];
        $noteSimulee = $_POST['noteSimulee'];
        if($noteSimulee >= 0 || $noteSimulee <= 20) {
            $epreuve = GetEpreuveFromId($idEpreuve);
            if(isset($epreuve)) {
                echo json_encode(GetNouvellesNotes(GetEtudiant($user)));
                $nouvellesNotes = [$noteSimulee];
                // On retourne la liste des nouvelles moyennes calculées
              //  echo json_encode($nouvellesNotes);
                return;
            }
        }
    }
}


function GetNouvellesNotes($etudiant) {
    $notes_et_moyennes = array();
    foreach(GetCompetenceListFromCursus($etudiant->GetCursus()->GetId()) as $competence) {
        $notes_et_moyennes[] = "comp_" + $competence->GetId() + "_moyenne_" + GetMoyenneFromCompetence($competence->GetId(), $etudiant->GetId());
    }
    echo var_dump($notes_et_moyennes);
    return $notes_et_moyennes;
}