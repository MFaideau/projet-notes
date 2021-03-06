<?php

if (isset($_POST['action']) && isset($_POST['idEpreuve']) && isset($_POST['noteSimulee'])) {
    if ($_POST['action'] == "changeNoteEpreuve") {
        $idEpreuve = $_POST['idEpreuve'];
        $noteSimulee = $_POST['noteSimulee'];
        if(is_numeric($noteSimulee)) {
            if (($noteSimulee >= 0 && $noteSimulee <= 20) || $noteSimulee == -1) {
                $epreuve = GetEpreuveFromId($idEpreuve);
                if (isset($epreuve)) {
                    $etudiant = GetEtudiant($user);
                    if(isset($user_vue))
                        $etudiant = GetEtudiant($user_vue);
                    
                    // On met à jour la base de données avec la note prévue
                    if($user->GetAutorite() == 1) {
                        $etudiantID=$etudiant->GetId();
                        $competenceId=GetCompetenceIdFromEpreuveId($idEpreuve);
                        $coursId=GetCoursIdFromEpreuveId($idEpreuve);
                        AddEtudiantNote($idEpreuve, $etudiantID, $noteSimulee, 0);
                        UpdateMoyenneCursusEtudiant(GetCursusIdFromEpreuveId($idEpreuve),$etudiantID,GetMoyenneFromCursus($etudiant->GetCursus()->GetId(),$etudiantID));
                        UpdateMoyenneCompetenceEtudiant($competenceId,$etudiantID,GetMoyenneFromCompetence($competenceId, $etudiantID));
                        UpdateMoyenneCoursEtudiant($coursId,$etudiantID,GetMoyenneFromCours($coursId, $etudiantID));
                    }
                    else {
                        AddEtudiantNotePrevue($idEpreuve, $etudiant->GetId(), $noteSimulee);
                    }
                    // On retourne la liste des nouvelles moyennes calculées
                    echo json_encode(GetNouvellesNotes($etudiant));
                    return;
                }
            }
        }
    }
}

if (isset($_POST['action']) && isset($_POST['idEpreuve'])) {
    if ($_POST['action'] == "changeAbsenceEpreuve") {
        $idEpreuve = $_POST['idEpreuve'];
        // vérification admin
        if (is_numeric($idEpreuve) && $user->GetAutorite() != 0) {
            $epreuve = GetEpreuveFromId($idEpreuve);
            if (isset($user_vue)) {
                $etudiant = GetEtudiant($user_vue);
                // Ce ne peut être qu'une absence non excusée (sinon c'est juste 0 en note)
                AddEtudiantNote($idEpreuve, $etudiant->GetId(), -1, 1);

                // On retourne la liste des nouvelles moyennes calculées
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
                    if (isset($etudiantNote)) {
                        $noteEpreuve = $etudiantNote->GetNoteFinale();
                        if ($noteEpreuve == -1) {
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

    // On refresh la moyenne générale
    $donnees = array(
        'type' => 'moyenne',
        'id' => '',
        'value' => round(GetMoyenneFromCursus($etudiant->GetCursus()->GetId(), $etudiant->GetId(), true), 2)
    );
    array_push($finalArray, $donnees);

    return $finalArray;
}