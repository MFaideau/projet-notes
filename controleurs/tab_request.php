<?php
/**
 * @Auteur: Joël Guillem
 * @Desc: Requête pour remplir les tableaux et histogrammes de notes
 */

function showHisto($moyenne, $note_etudiant, $ecart_type) {
    $taille_rect = $note_etudiant / 20;
    $taille_rect_pourcent = $taille_rect * 100;
    if ($taille_rect == 0) {
        $taille_couleur = 0;
    } else {
        $taille_couleur = (1 / $taille_rect) * 100;
    }
    $position_moyenne = ($moyenne / 20) * 100;
    $position_e_t_high = $position_moyenne + (($ecart_type / 2) / 20) * 100;
    $position_e_t_low = $position_moyenne - (($ecart_type / 2) / 20) * 100;
    return array([$taille_couleur,$taille_rect_pourcent,$position_moyenne,$position_e_t_low, $position_e_t_high]);
}

function getStat($tab_notes) {
    $effectif = count($tab_notes);
    if ($effectif==0) {
        return -1;
    }
    else {
        $somme = 0;
        $somme_carres = 0;
        $note_max = $tab_notes[0];
        $note_min = $tab_notes[0];
        for ($i = 0; $i < $effectif; $i++) {
            $somme = $somme + $tab_notes[$i];
            $somme_carres = $somme_carres + pow($tab_notes[$i], 2);
            if ($note_max < $tab_notes[$i]) {
                $note_max = $tab_notes[$i];
            }
            if ($note_min > $tab_notes[$i]) {
                $note_min = $tab_notes[$i];
            }
        }
        $moyenne = $somme / $effectif;
        $moyenne_carres = $somme_carres / $effectif;
        $variance = $moyenne_carres - pow($moyenne, 2);
        $ecart_type = sqrt($variance);
        return array($moyenne, $ecart_type, $note_min, $note_max);
    }
}

function GetNotePonderee($note, $coefficient) {
    return $note*$coefficient;
}

function GetMoyenneFromTypeEval($idTypeEval, $idEtudiant) {
    $listEpreuves = GetEpreuveListFromTypeEval($idTypeEval);
    $notesEtudiant = array();
    $somme = 0;
    foreach ($listEpreuves as $i => $epreuves) {
        $notesEtudiant[$i] = GetEtudiantNoteFromEtudiantEpreuve($idEtudiant, $epreuves->GetId())->GetNoteFinale();
        $somme = $somme + $notesEtudiant[$i];
    }
    $moyenne = $somme / count($notesEtudiant);
    return $moyenne;
}

function GetMoyenneFromEval($idEval, $idEtudiant) {
    $listTypeEval = GetTypeEvalListFromEval($idEval);
    $notesEtudiant = array();
    $moyenne = 0;
    foreach ($listTypeEval as $i => $typeEval) {
        $notesEtudiant[$i] = GetMoyenneFromTypeEval($typeEval->GetId(), $idEtudiant);
        $moyenne = $moyenne + GetNotePonderee($notesEtudiant[$i], $typeEval->GetCoef());
    }
    return $moyenne;
}

function GetMoyenneFromCours($idCours, $idEtudiant) {
    $listEval = GetEvalListFromCours($idCours);
    $notesEtudiant = array();
    $moyenne = 0;
    foreach ($listEval as $i => $eval) {
        $notesEtudiant[$i] = GetMoyenneFromEval($eval->GetId(), $idEtudiant);
        $moyenne = $moyenne + GetNotePonderee($notesEtudiant[$i], $eval->GetCoef());
    }
    return $moyenne;
}

function GetMoyenneFromCompetence($idCompetence, $idEtudiant) {
    $listCours = GetCoursListFromCompetence($idCompetence);
    $notesEtudiant = array();
    $moyenne = 0;
    foreach ($listCours as $i => $cours) {
        $notesEtudiant[$i] = GetMoyenneFromCours($cours->GetId(), $idEtudiant);
        $moyenne = $moyenne + GetNotePonderee($notesEtudiant[$i], $cours->GetCoef());
    }
    return $moyenne;
}

function GetTabNotesEtudiantsFromEpreuve($idEpreuve) {
    $listEtudiants = GetEtudiantNotesFromEpreuve($idEpreuve);
    $notesEtudiants = array();
    foreach ($listEtudiants as $i => $etudiantNote) {
        if ($etudiantNote->GetAbsence()==0 || $etudiantNote->GetAbsence()==2) {
            $notesEtudiants[] = $etudiantNote->noteFinale;
        }
    }
    return $notesEtudiants;
}

function GetTabNotesEtudiantsFromTypeEval($idTypeEval) {
    $listEpreuves = GetEpreuveListFromTypeEval($idTypeEval);
    $tab = array();
    $taille_max = 0;
    $notesEtudiants = array();
    foreach ($listEpreuves as $i => $epreuves) {
        $tab[$i] = GetTabNotesEtudiantsFromEpreuve($epreuves->id);
        if ($taille_max < count($tab[$i])) {
            $taille_max = count($tab[$i]);
        }
    }
    for ($j=0;$j<$taille_max;$j++) {

    }
}

function GetTabNotesEtudiantsFromEval($idEval) {

}

function GetTabNotesEtudiantsFromCours($idCours) {

}

function GetTabNotesEtudiantsFromCompetence($idCompetence) {

}
