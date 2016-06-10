<?php
/**
 * @Auteur: Joël Guillem
 * @Desc: Requête pour remplir les tableaux et histogrammes de notes
 */

$listEtudiantsFromCursus = GetEtudiantListFromCursus(GetEtudiant($user)->GetCursus());

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

function GetStat($tab_notes) {
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
    foreach ($listEpreuves as $i => $epreuve) {
        $studentnote = GetEtudiantNoteFromEtudiantEpreuve($idEtudiant, $epreuve->GetId());
        if (isset($studentnote)) {
            if ($studentnote->GetAbsence() == 1) {
                $i = $i-1;
            }
            else {
                $notesEtudiant[$i] = $studentnote->GetNoteFinale();
                $somme = $somme + $notesEtudiant[$i];
            }
        }
    }
    if (count($notesEtudiant) == 0) {
        return -1;
    }
    $moyenne = $somme / count($notesEtudiant);
    return $moyenne;
}

function GetMoyenneFromEval($idEval, $idEtudiant) {
    $listTypeEval = GetTypeEvalListFromEval($idEval);
    $notesEtudiant = array();
    $moyenne = 0;
    $sommecoef = 0;
    foreach ($listTypeEval as $i => $typeEval) {
        $studentnote = GetMoyenneFromTypeEval($typeEval->GetId(), $idEtudiant);
        $coefTypeEval = $typeEval->GetCoef();
        if (isset($studentnote)) {
            if ($studentnote == -1) {
                $i = $i-1;
            }
            else {
                $notesEtudiant[$i] = $studentnote;
                $moyenne = $moyenne + GetNotePonderee($notesEtudiant[$i], $coefTypeEval);
            }
            $sommecoef = $sommecoef + $coefTypeEval;
        }
    }
    if ($sommecoef == 0) {
        return -1;
    }
    return $moyenne/$sommecoef;
}

function GetMoyenneFromCours($idCours, $idEtudiant) {
    $listEval = GetEvalListFromCours($idCours);
    $notesEtudiant = array();
    $moyenne = 0;
    $sommecoef = 0;
    foreach ($listEval as $i => $eval) {
        $studentnote = GetMoyenneFromEval($eval->GetId(), $idEtudiant);
        $coefEval = $eval->GetCoef();
        if (isset($studentnote)) {
            if ($studentnote == -1) {
                $i = $i-1;
            }
            else {
                $notesEtudiant[$i] = $studentnote;
                $moyenne = $moyenne + GetNotePonderee($notesEtudiant[$i], $coefEval);
            }
            $sommecoef = $sommecoef + $coefEval;
        }
    }
    if ($sommecoef == 0) {
        return -1;
    }
    return $moyenne/$sommecoef;
}

function GetMoyenneFromCompetence($idCompetence, $idEtudiant) {
    $listCours = GetCoursListFromCompetence($idCompetence);
    $notesEtudiant = array();
    $moyenne = 0;
    $sommecredits = 0;
    foreach ($listCours as $i => $cours) {
        $studentnote = GetMoyenneFromCours($cours->GetId(), $idEtudiant);
        $creditscours = $cours->GetCredits();
        if (isset($studentnote)) {
            if ($studentnote == -1) {
                $i = $i-1;
            }
            else {
                $notesEtudiant[$i] = $studentnote;
                $moyenne = $moyenne + GetNotePonderee($notesEtudiant[$i], $creditscours);
            }
            $sommecredits = $sommecredits + $creditscours;
        }
    }
    if ($sommecredits == 0) {
        return -1;
    }
    else {
        return $moyenne/$sommecredits;
    }
}

function GetMoyenneFromCursus($idCursus, $idEtudiant) {
    $listCompetence = GetCompetenceListFromCursus($idCursus);
    $notesEtudiant = array();
    $moyenne = 0;
    foreach ($listCompetence as $i => $competence) {
        $notesEtudiant[$i] = GetMoyenneFromCompetence($competence->GetId(), $idEtudiant);
        $moyenne = $moyenne + GetNotePonderee($notesEtudiant[$i], $competence->GetCredits());
    }
    $creditscursus = GetCreditsFromCursus($idCursus);
    return $moyenne/$creditscursus;
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
    $notesEtudiants = array();
    global $listEtudiantsFromCursus;
    foreach ($listEtudiantsFromCursus as $etudiant) {
        $notesEtudiants[] = GetMoyenneFromTypeEval($idTypeEval, $etudiant->GetId());
    }
    return $notesEtudiants;
}

function GetTabNotesEtudiantsFromEval($idEval) {
    $notesEtudiants = array();
    global $listEtudiantsFromCursus;
    foreach ($listEtudiantsFromCursus as $etudiant) {
        $notesEtudiants[] = GetMoyenneFromEval($idEval, $etudiant->GetId());
    }
    return $notesEtudiants;
}

function GetTabNotesEtudiantsFromCours($idCours) {
    $notesEtudiants = array();
    global $listEtudiantsFromCursus;
    foreach ($listEtudiantsFromCursus as $etudiant) {
        $notesEtudiants[] = GetMoyenneFromCours($idCours, $etudiant->GetId());
    }
    return $notesEtudiants;
}

function GetTabNotesEtudiantsFromCompetence($idCompetence) {
    $notesEtudiants = array();
    global $listEtudiantsFromCursus;
    foreach ($listEtudiantsFromCursus as $etudiant) {
        $notesEtudiants[] = GetMoyenneFromCompetence($idCompetence, $etudiant->GetId());
    }
    return $notesEtudiants;
}

function GetTabNotesEtudiantsFromCursus($idCursus) {
    $notesEtudiants = array();
    global $listEtudiantsFromCursus;
    foreach ($listEtudiantsFromCursus as $etudiant) {
        $notesEtudiants[] = GetMoyenneFromCursus($idCursus, $etudiant->GetId());
    }
    return $notesEtudiants;
}

function GetVarTabHistoBatons($tabNotes) {
    $tabCompteurNotes = array();
    $compteur = 0;
    for ($i=0;$i<=40;$i++) {
        for ($j=0;$j<count($tabNotes);$j++) {
            if (($tabNotes[$j] >= $i/2) && ($tabNotes[$j] < ($i+1)/2)) {
                $compteur++;
            }
            $tabCompteurNotes[$i] = $compteur;
        }
        $compteur = 0;
    }
    return $tabCompteurNotes;
}
