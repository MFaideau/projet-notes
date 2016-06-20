<?php
defined("ROOT_ACCESS") or die();

/**
 * @Auteur: Joël Guillem
 * @Desc: Requête pour remplir les tableaux et histogrammes de notes
 */
if(isset($user)) {
    $listEtudiantsFromCursus = GetEtudiantListFromCursus(GetEtudiant($user)->GetCursus());
}
if(isset($_SESSION['user_vue'])) {
    if ($user->GetAutorite() != 0) {
        $user_vue = unserialize($_SESSION['user_vue']);
        $listEtudiantsFromCursus = GetEtudiantListFromCursus(GetEtudiant($user_vue)->GetCursus());
    }
}

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

function TestValidite($variable) {
    if ($variable == -1) return "-";
    else return $variable;
}

function GetStat($tab_notes) {
    $effectif = count($tab_notes);
    if ($effectif==0) {
        return -1;
    }
    else {
        $somme = 0;
        $somme_carres = 0;
        $note_max = -1;
        $note_min = -1;
        for ($i = 0; $i < $effectif; $i++) {
            $somme = $somme + $tab_notes[$i];
            $somme_carres = $somme_carres + pow($tab_notes[$i], 2);
            if ($tab_notes[$i] > -1) {
                if ($note_max < $tab_notes[$i]) {
                    $note_max = $tab_notes[$i];
                }
                if ($note_min == -1) {
                    $note_min = $tab_notes[$i];
                }
                elseif ($note_min > $tab_notes[$i]) {
                    $note_min = $tab_notes[$i];
                }
            }
        }
        $moyenne = $somme / $effectif;
        $moyenne_carres = $somme_carres / $effectif;
        $variance = $moyenne_carres - pow($moyenne, 2);
        $ecart_type = sqrt($variance);
        $tab = array($moyenne, $ecart_type, $note_min, $note_max);
        return $tab;
    }
}

function GetEffectifNonGrades($tab, $size) {
    $compteur = 0;
    for ($i=0;$i<$size;$i++) {
        if ($tab[$i] < 10) {
            $compteur = $compteur+1;
        }
    }
    return $compteur;
}

function GetGradeFromCursus($idCursus, $idEtudiant) {
    global $listEtudiantsFromCursus;
    $studentnote = GetTabNotesEtudiantsFromCursus($idCursus);
    $size = count($studentnote);
    $moyenneCursus = GetMoyenneFromCursus($idCursus, $idEtudiant);
    $effectifTotal = count($listEtudiantsFromCursus);
    $effectifNonGrades = GetEffectifNonGrades($studentnote, $size);
    $effectifGrades = $effectifTotal - $effectifNonGrades;
    $tabNotesOrdonne = arsort($studentnote);
    $i = 0;
    while ($moyenneCursus < $tabNotesOrdonne[$i]) {
        $i = $i + 1;
    }
    if ($moyenneCursus < 8) {
        return "F";
    }
    elseif (($moyenneCursus < 10)&&($moyenneCursus >= 8)) {
        return "Fx";
    }
    else {
        $coefficient = $i / ($effectifGrades - 1);
        if ($coefficient < 0.1) {
            return "A";
        }
        elseif (($coefficient < 0.35)&&($coefficient >= 0.1)) {
            return "B";
        }
        elseif (($coefficient < 0.65)&&($coefficient >= 0.35)) {
            return "C";
        }
        elseif (($coefficient < 0.9)&&($coefficient >= 0.65)) {
            return "D";
        }
        elseif (($coefficient <= 1)&&($coefficient >= 0.9)) {
            return "E";
        }
        else {
            return "F";
        }
    }
}

function GetNotePonderee($note, $coefficient) {
    return $note*$coefficient;
}

function GetBestNote($epreuve, $epreuveRattrapage, $idEtudiant) {
    $etudiantNote = GetEtudiantNoteFromEtudiantEpreuve($idEtudiant, $epreuve);
    $etudiantNoteRattrapage = GetEtudiantNoteFromEtudiantEpreuve($idEtudiant, $epreuveRattrapage);
    if (isset($etudiantNote)) {
        if (isset($etudiantNoteRattrapage)) {
            $note = $etudiantNote->GetNoteFinale();
            $noteRattrapage = $etudiantNoteRattrapage->GetNoteFinale();
            if ($note >= $noteRattrapage) {
                return $note;
            }
            else return $noteRattrapage;
        }
        $note = $etudiantNote->GetNoteFinale();
        return $note;
    }
    elseif (isset($etudiantNoteRattrapage)) {
        $noteRattrapage = $etudiantNoteRattrapage->GetNoteFinale();
        return $noteRattrapage;
    }
    return -1;
}

function GestionAbsenceEpreuve($epreuve, $idEtudiant) {
    $etudiantNote = GetEtudiantNoteFromEtudiantEpreuve($idEtudiant, $epreuve->GetId());
    if (isset($etudiantNote)) {
        $absence = $etudiantNote->GetAbsence();
        if ($absence == 1) {
            $idSubstitution = $epreuve->GetIdSubstitution();
            if ($idSubstitution > 0) {
                $epreuveSubstitution = GetEpreuveFromId($idSubstitution);
                $etudiantNoteSubstitution = GetEtudiantNoteFromEtudiantEpreuve($idEtudiant, $idSubstitution);
                $absenceSubstitution = $etudiantNoteSubstitution->GetAbsence();
                if ($absenceSubstitution == 1) {
                    $note = GestionAbsenceEpreuve($epreuveSubstitution, $idEtudiant);
                }
                elseif ($absenceSubstitution == 2) {
                    $note = 0;
                }
                else {
                    $idRattrapage = $epreuveSubstitution->GetIdSecondeSession();
                    if ($idRattrapage > 0) {
                        $epreuveRattrapage = GetEpreuveFromId($idRattrapage);
                        $note = GetBestNote($epreuveSubstitution, $epreuveRattrapage, $idEtudiant);
                    }
                    else $note = $etudiantNoteSubstitution->GetNoteFinale();
                }
            }
            else $note = -1;
        }
        elseif ($absence == 2) {
            $note = 0;
        }
        else {
            $idRattrapage = $epreuve->GetIdSecondeSession();
            if ($idRattrapage > 0) {
                $epreuveRattrapage = GetEpreuveFromId($idRattrapage);
                $note = GetBestNote($epreuve, $epreuveRattrapage, $idEtudiant);
            }
            else $note = $etudiantNote->GetNoteFinale();
        }
        return $note;
    }
    else return -1;
}

function GetMoyenneFromTypeEval($idTypeEval, $idEtudiant) {
    $listEpreuves = GetEpreuveListFromTypeEval($idTypeEval);
    $notesEtudiant = array();
    $somme = 0;
    $sommecoef = 0;
    foreach ($listEpreuves as $i => $epreuve) {
        $coefEpreuve = $epreuve->GetCoef();
        $note = GestionAbsenceEpreuve($epreuve, $idEtudiant);
        if ($note == -1) {
            $i = $i-1;
        }
        else {
            $notesEtudiant[$i] = $note;
            $somme = $somme + GetNotePonderee($notesEtudiant[$i], $coefEpreuve);
            $sommecoef = $sommecoef + $coefEpreuve;
        }
    }
    if (count($notesEtudiant) == 0) {
        return -1;
    }
    $moyenne = $somme / $sommecoef;
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
                $sommecoef = $sommecoef + $coefTypeEval;
            }
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
                $sommecoef = $sommecoef + $coefEval;
            }
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
                $sommecredits = $sommecredits + $creditscours;
            }
        }
    }
    // echo "Credits : ", var_dump($sommecredits);
    // echo "Moyenne : ", $moyenne;
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
    $sommecredits = 0;
    foreach ($listCompetence as $i => $competence) {
        $notesEtudiant[$i] = GetMoyenneFromCompetence($competence->GetId(), $idEtudiant);
        if ($notesEtudiant[$i] != -1) {
            $moyenne = $moyenne + GetNotePonderee($notesEtudiant[$i], $competence->GetCredits());
            $sommecredits = $sommecredits + $competence->GetCredits();
        }
    }
    if ($sommecredits == 0) {
        return -1;
    }
    return $moyenne/$sommecredits;
}

function GetTabNotesEtudiantsFromEpreuve($idEpreuve) {
    global $listEtudiantsFromCursus;
    $notesEtudiants = array();
    foreach ($listEtudiantsFromCursus as $i => $etudiant) {
        $idEtudiant = $etudiant->GetId();
        $etudiantNote = GetEtudiantNoteFromEtudiantEpreuve($idEtudiant, $idEpreuve);
        if (isset($etudiantNote)) {
            $absenceEtudiant = $etudiantNote->GetAbsence();
            if (($absenceEtudiant == 0) || ($absenceEtudiant == 2)) {
                $notesEtudiants[] = $etudiantNote->GetNoteFinale();
            }
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
