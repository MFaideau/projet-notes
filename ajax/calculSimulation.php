<?php
define("ROOT_ACCESS",true);
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
$idEtudiant = GetEtudiant($user)->GetId();
include_once __DIR__ . '../../controleurs/tab_request.php';

if (isset($_POST['action']) && isset($_POST['idEpreuve']) && isset($_POST['noteSimulee'])) {
    if ($_POST['action'] == "changeNoteEpreuve") {
        $idEpreuve = $_POST['idEpreuve'];
        $noteSimulee = $_POST['noteSimulee'];
        if ($noteSimulee >= 0 || $noteSimulee <= 20) {
            $epreuve = GetEpreuveFromId($idEpreuve);
            if (isset($epreuve)) {
                $etudiant = GetEtudiant($user);
                // On met à jour la base de données avec la note prévue
                AddEtudiantNotePrevue($idEpreuve, $etudiant->GetId(), $noteSimulee);

                // On retourne la liste des nouvelles moyennes calculées=
                echo json_encode(GetNouvellesNotes($etudiant));
                return;
            }
        }
    }
}


function GetNouvellesNotes($etudiant)
{
    $finalArray = array();
    foreach (GetCompetenceListFromCursus($etudiant->GetCursus()->GetId()) as $competence) {
        $donnees = array(
            'type' => 'competence',
            'id' => $competence->GetId(),
            'value' => round(GetMoyenneFromCompetence($competence->GetId(), $etudiant->GetId(), true), 2)
        );
        array_push($finalArray, $donnees);

        // On fait pareil pour les cours
        foreach (GetCoursListFromCompetence($competence->GetId()) as $cours) {
            $donnees = array(
                'type' => 'cours',
                'id' => $cours->GetId(),
                'value' => round(GetMoyenneFromCours($cours->GetId(), $etudiant->GetId(), true), 2)
            );
            array_push($finalArray, $donnees);

            // On fait pareil pour les type_eval
            foreach (GetTypeEvalListFromCours($cours->GetId()) as $typeEval) {
                $donnees = array(
                    'type' => 'typeEval',
                    'id' => $typeEval->GetId(),
                    'value' => round(GetMoyenneFromTypeEval($typeEval->GetId(), $etudiant->GetId(), true), 2)
                );
                array_push($finalArray, $donnees);

                // On fait pareil pour les épreuves
                foreach (GetEpreuveListFromTypeEval($typeEval->GetId()) as $epreuve) {
                    $etudiantNote = GetEtudiantNoteFromEtudiantEpreuve($etudiant->GetId(), $epreuve->GetId());
                    if(isset($etudiantNote)) {
                        $noteEpreuve = $etudiantNote->GetNoteFinale();
                        if($noteEpreuve == -1) {
                            $noteEpreuve = $etudiantNote->GetNotePrevue();
                        }
                        $donnees = array(
                            'type' => 'epreuve',
                            'id' => $epreuve->GetId(),
                            'value' => $noteEpreuve
                    );
                        array_push($finalArray, $donnees);
                    }
                }
            }
        }
    }

    return $finalArray;
}