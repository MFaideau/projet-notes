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

// Utilisé pour l'affichage (s'il n'y a pas de note)
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

// Retourne le nombre d'étudiants qui n'ont pas la moyenne
function GetEffectifNonGrades($tab, $size) {
    $compteur = 0;
    for ($i=0;$i<$size;$i++) {
        if ($tab[$i] < 10) {
            $compteur = $compteur+1;
        }
    }
    return $compteur;
}

function AttributionGrade($coefficient) {
    if ($coefficient < 0.1) return "A";
    elseif (($coefficient < 0.35) && ($coefficient >= 0.1)) return "B";
    elseif (($coefficient < 0.65) && ($coefficient >= 0.35)) return "C";
    elseif (($coefficient < 0.9) && ($coefficient >= 0.65)) return "D";
    elseif (($coefficient <= 1) && ($coefficient >= 0.9)) return "E";
    else return "F";
}

function GetGradeFromEpreuve($idEpreuve, $idEtudiant, $isSimulation = false) {
    global $listEtudiantsFromCursus;
    $studentnote = GetTabNotesEtudiantsFromEpreuve($idEpreuve);
    if (isset($studentnote)) {

        // Tri du tableau de notes et obtention du rang de l'étudiant
        $size = count($studentnote);
        $moyenneEpreuve = GetNoteSimulation(GetEtudiantNoteFromEtudiantEpreuve($idEtudiant, $idEpreuve));
        $effectifTotal = count($listEtudiantsFromCursus);
        $effectifNonGrades = GetEffectifNonGrades($studentnote, $size);
        $effectifGrades = $effectifTotal - $effectifNonGrades;
        arsort($studentnote);
        $rang = 0;

        // On reordonne le tableau et on cherche le rang
        $studentNoteKey = array();
        foreach ($studentnote as $note)
            $studentNoteKey[] = $note;

        while ($moyenneEpreuve < $studentNoteKey[$rang]) {
            $rang = $rang + 1; //Calcul du rang
        }

        // Attribution du grade selon sa moyenne
        if ($moyenneEpreuve < 0) return "-";
        if ($moyenneEpreuve < 8) return "F";
        elseif (($moyenneEpreuve < 10) && ($moyenneEpreuve >= 8)) return "Fx";
        else {
            if ($effectifGrades == 1) return "A"; // Si 1 seul étudiant noté
            $coefficient = $rang / ($effectifGrades - 1);
            return AttributionGrade($coefficient);
        }
    }
    else return "-"; // Si pas d'étudiants, pas de grade
}

function GetGradeFromCours($idCours, $idEtudiant, $isSimulation = false) {
    global $listEtudiantsFromCursus;
    $studentnote = GetTabNotesEtudiantsFromCours($idCours);
    if (isset($studentnote)) {

        // Tri du tableau de notes et obtention du rang de l'étudiant
        $size = count($studentnote);
        $moyenneCours = GetMoyenneFromCours($idCours, $idEtudiant);
        $effectifTotal = count($listEtudiantsFromCursus);
        $effectifNonGrades = GetEffectifNonGrades($studentnote, $size);
        $effectifGrades = $effectifTotal - $effectifNonGrades;
        arsort($studentnote);
        $rang = 0;

        // On reordonne le tableau et on cherche le rang
        $studentNoteKey = array();
        foreach ($studentnote as $note)
            $studentNoteKey[] = $note;

        while ($moyenneCours < $studentNoteKey[$rang]) {
            $rang = $rang + 1; //Calcul du rang
        }

        // Attribution du grade selon sa moyenne
        if ($moyenneCours < 0) return "-";
        if ($moyenneCours < 8) return "F";
        elseif (($moyenneCours < 10) && ($moyenneCours >= 8)) return "Fx";
        else {
            if ($effectifGrades == 1) return "A"; // Si 1 seul étudiant noté
            $coefficient = $rang / ($effectifGrades - 1);
            return AttributionGrade($coefficient);
        }
    }
    else return "-"; // Si pas d'étudiants, pas de grade
}

function GetGradeFromCompetence($idCompetence, $idEtudiant, $isSimulation = false) {
    global $listEtudiantsFromCursus;
    $studentnote = GetTabNotesEtudiantsFromCompetence($idCompetence);
    if (isset($studentnote)) {

        // Tri du tableau de notes et obtention du rang de l'étudiant
        $size = count($studentnote);
        $moyenneCompetence = GetMoyenneFromCompetence($idCompetence, $idEtudiant, $isSimulation);
        $effectifTotal = count($listEtudiantsFromCursus);
        $effectifNonGrades = GetEffectifNonGrades($studentnote, $size);
        $effectifGrades = $effectifTotal - $effectifNonGrades;
        arsort($studentnote);
        $rang = 0;

        // On reordonne le tableau et on cherche le rang
        $studentNoteKey = array();
        foreach ($studentnote as $note)
            $studentNoteKey[] = $note;

        while ($moyenneCompetence < $studentNoteKey[$rang]) {
            $rang = $rang + 1; //Calcul du rang
        }

        // Attribution du grade selon sa moyenne
        if ($moyenneCompetence < 0) return "-";
        if ($moyenneCompetence < 8) return "F";
        elseif (($moyenneCompetence < 10) && ($moyenneCompetence >= 8)) return "Fx";
        else {
            if ($effectifGrades == 1) return "A"; // Si 1 seul étudiant noté
            $coefficient = ($rang) / ($effectifGrades - 1);
            return AttributionGrade($coefficient);
        }
    }
    else return "-"; // Si pas d'étudiants, pas de grade
}

function GetGradeFromCursus($idCursus, $idEtudiant, $isSimulation = false) {
    global $listEtudiantsFromCursus;
    $studentnote = GetTabNotesEtudiantsFromCursus($idCursus);
    if (isset($studentnote)) {

        // Tri du tableau de notes et obtention du rang de l'étudiant
        $size = count($studentnote);
        $moyenneCursus = GetMoyenneFromCursus($idCursus, $idEtudiant, $isSimulation);
        $effectifTotal = count($listEtudiantsFromCursus);
        $effectifNonGrades = GetEffectifNonGrades($studentnote, $size);
        $effectifGrades = $effectifTotal - $effectifNonGrades;
        arsort($studentnote);
        $rang = 0;

        // On reordonne le tableau et on cherche le rang
        $studentNoteKey = array();
        foreach ($studentnote as $note)
            $studentNoteKey[] = $note;

        while ($moyenneCursus < $studentNoteKey[$rang]) {
            $rang = $rang + 1; //Calcul du rang
        }

        // Attribution du grade selon sa moyenne
        if ($moyenneCursus < 0) return "-";
        if ($moyenneCursus < 8) return "F";
        elseif (($moyenneCursus < 10) && ($moyenneCursus >= 8)) return "Fx";
        else {
            if ($effectifGrades == 1) return "A"; // Si 1 seul étudiant noté
            $coefficient = $rang / ($effectifGrades - 1);
            return AttributionGrade($coefficient);
        }
    }
    else return "-"; // Si pas d'étudiants, pas de grade
}

function GetNotePonderee($note, $coefficient) {
    return $note*$coefficient;
}

function SimulationValidation($moyenne) {
    
}

function GetNoteSimulation($etudiantNote, $isSimulation = false) {
    if (!isset($etudiantNote))
        return -1;
    $noteFinale = $etudiantNote->GetNoteFinale();
    $notePrevue = $etudiantNote->GetNotePrevue();
    if ($noteFinale == -1 && $isSimulation)
        return $notePrevue;
    return $noteFinale;
}

function GetBestNote($epreuve, $epreuveRattrapage, $idEtudiant, $isSimulation = false) {
    $etudiantNote = GetEtudiantNoteFromEtudiantEpreuve($idEtudiant, $epreuve->GetId());
    $etudiantNoteRattrapage = GetEtudiantNoteFromEtudiantEpreuve($idEtudiant, $epreuveRattrapage->GetId());
    if (isset($etudiantNote)) {
        if (isset($etudiantNoteRattrapage)) {
            $note = GetNoteSimulation($etudiantNote, $isSimulation);
            $noteRattrapage = GetNoteSimulation($etudiantNoteRattrapage, $isSimulation);
            if ($note >= $noteRattrapage) {
                return $note;
            }
            else return $noteRattrapage;
        }
        else {
            $note = GetNoteSimulation($etudiantNote, $isSimulation);
            return $note;
        }
    }
    elseif (isset($etudiantNoteRattrapage)) {
        $noteRattrapage = GetNoteSimulation($etudiantNoteRattrapage, $isSimulation);
        return $noteRattrapage;
    }
    return -1;
}

function GestionAbsenceEpreuve($epreuve, $idEtudiant, $isSimulation = false) {
    $etudiantNote = GetEtudiantNoteFromEtudiantEpreuve($idEtudiant, $epreuve->GetId(), $isSimulation);
    if (isset($etudiantNote)) {
        $absence = $etudiantNote->GetAbsence();
        if ($absence == 1) {
            $idSubstitution = $epreuve->GetIdSubstitution();
            $idRattrapage = $epreuve->GetIdSecondeSession();
            if ($idSubstitution > 0) {
                $epreuveSubstitution = GetEpreuveFromId($idSubstitution);
                $etudiantNoteSubstitution = GetEtudiantNoteFromEtudiantEpreuve($idEtudiant, $idSubstitution);
                if (isset($etudiantNoteSubstitution)) {
                    $absenceSubstitution = $etudiantNoteSubstitution->GetAbsence();
                    if ($absenceSubstitution == 1) {
                        $note = GestionAbsenceEpreuve($epreuveSubstitution, $idEtudiant, $isSimulation);
                    } elseif ($absenceSubstitution == 2) {
                        $note = 0;
                    } else {
                        $idSubstitutionRattrapage = $epreuveSubstitution->GetIdSecondeSession();
                        if ($idSubstitutionRattrapage > 0) {
                            $epreuveSubstitutionRattrapage = GetEpreuveFromId($idSubstitutionRattrapage);
                            $note = GetBestNote($epreuveSubstitution, $epreuveSubstitutionRattrapage, $idEtudiant, $isSimulation);
                        } else $note = GetNoteSimulation($etudiantNoteSubstitution, $isSimulation);
                    }
                }
                else $note = -1;
            }
            elseif ($idRattrapage > 0) {
                $epreuveRattrapage = GetEpreuveFromId($idRattrapage);
                $etudiantNoteRattrapage = GetEtudiantNoteFromEtudiantEpreuve($idEtudiant, $idRattrapage);
                if(isset($etudiantNoteRattrapage)) {
                    $absenceRattrapage = $etudiantNoteRattrapage->GetAbsence();
                    if ($absenceRattrapage == 1) {
                        $note = GestionAbsenceEpreuve($epreuveRattrapage, $idEtudiant, $isSimulation);
                    } elseif ($absenceRattrapage == 2) {
                        $note = 0;
                    } else {
                        $note = GetNoteSimulation($etudiantNoteRattrapage, $isSimulation);
                    }
                }
                else $note = -1;
            }
            else $note = -1;
        }
        elseif ($absence == 2) {
            $note = 0;
        }
        elseif ($absence == 0) {
            $idRattrapage = $epreuve->GetIdSecondeSession();
            if ($idRattrapage > 0) {
                $epreuveRattrapage = GetEpreuveFromId($idRattrapage);
                $etudiantNoteRattrapage = GetEtudiantNoteFromEtudiantEpreuve($idEtudiant, $idRattrapage);
                if(isset($etudiantNoteRattrapage)) {
                    $absenceRattrapage = $etudiantNoteRattrapage->GetAbsence();
                    if ($absenceRattrapage == 1) {
                        $note = GetNoteSimulation($etudiantNote, $isSimulation);
                    } elseif ($absenceRattrapage == 2) {
                        $note = GetNoteSimulation($etudiantNote, $isSimulation);
                    } else {
                        $note = GetBestNote($epreuve, $epreuveRattrapage, $idEtudiant, $isSimulation);
                    }
                }
                else $note = GetNoteSimulation($etudiantNote, $isSimulation);
            }
            else $note = GetNoteSimulation($etudiantNote, $isSimulation);
        }
        return $note;
    }
    else return -1;
}

function GetArrayLine($array,$id)
{
    foreach($array as $line)
    {
        if($line[0]==$id){return $line[1];}
    }
    return null;
}

$epreuveLists=array();
$epreuveSecondeSessionLists = array();

function GetMoyenneFromTypeEval($idTypeEval, $idEtudiant, $isSimulation = false) {
    global $epreuveLists;
    global $epreuveSecondeSessionLists;
    $listEpreuves = GetArrayLine($epreuveLists, $idTypeEval);
    if (!isset($listEpreuves)){
        $listEpreuves=GetEpreuveListFromTypeEval($idTypeEval);
        $epreuveLists[]=array($idTypeEval,$listEpreuves);
    }
    $listSecondesSessions = GetArrayLine($epreuveSecondeSessionLists, $idTypeEval);
    if (!isset($listSecondesSessions)){
        $listSecondesSessions=GetEpreuveSecondeSessionListFromTypeEval($idTypeEval);
        $epreuveSecondeSessionLists[]=array($idTypeEval,$listSecondesSessions);
    }
    $notesEtudiant = array();
    $somme = 0;
    $sommecoef = 0;
    foreach ($listEpreuves as $i => $epreuve) {
        if(!in_array($epreuve, $listSecondesSessions)) {
            $coefEpreuve = $epreuve->GetCoef();
            $note = GestionAbsenceEpreuve($epreuve, $idEtudiant, $isSimulation);
            if ($note == -1) {
                $i = $i - 1;
            } else {
                $notesEtudiant[$i] = $note;
                $somme = $somme + GetNotePonderee($notesEtudiant[$i], $coefEpreuve);
                $sommecoef = $sommecoef + $coefEpreuve;
            }
        }
    }
    if (count($notesEtudiant) == 0) {
        return -1;
    }
    $moyenne = $somme / $sommecoef;
    return $moyenne;
}

$typeEvalLists=array();

function GetMoyenneFromEval($idEval, $idEtudiant, $isSimulation = false) {
    global $typeEvalLists;
    $listTypeEval = GetArrayLine($typeEvalLists, $idEval);
    if (!isset($listTypeEval)){
        $listTypeEval=GetTypeEvalListFromEval($idEval);
        $typeEvalLists[]=array($idEval,$listTypeEval);
    }
    $notesEtudiant = array();
    $moyenne = 0;
    $sommecoef = 0;
    foreach ($listTypeEval as $i => $typeEval) {
        $studentnote = GetMoyenneFromTypeEval($typeEval->GetId(), $idEtudiant, $isSimulation);
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

$evalLists=array();

function GetMoyenneFromCours($idCours, $idEtudiant, $isSimulation = false) {
    global $evalLists;
    $listEval = GetArrayLine($evalLists,$idCours);
    if (!isset($listEval)){
        $listEval=GetEvalListFromCours($idCours);
        $evalLists[]=array($idCours,$listEval);
    }
    $notesEtudiant = array();
    $moyenne = 0;
    $sommecoef = 0;
    foreach ($listEval as $i => $eval) {
        $studentnote = GetMoyenneFromEval($eval->GetId(), $idEtudiant, $isSimulation);
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
    if ($sommecoef == 0)
        return -1;
    return $moyenne/$sommecoef;
}

$coursLists=array();

function GetMoyenneFromCompetence($idCompetence, $idEtudiant, $isSimulation = false) {
    global $coursLists;
    $listCours = GetArrayLine($coursLists,$idCompetence);
    if (!isset($listCours)){
        $listCours=GetCoursListFromCompetence($idCompetence);
        $coursLists[]=array($idCompetence,$listCours);
    }
    $notesEtudiant = array();
    $moyenne = 0;
    $sommecredits = 0;
    foreach ($listCours as $i => $cours) {
        $studentnote = GetMoyenneFromCours($cours->GetId(), $idEtudiant, $isSimulation);
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
    if ($sommecredits == 0)
        return -1;
    else
        return $moyenne/$sommecredits;
}

$competenceLists=array();

function GetMoyenneFromCursus($idCursus, $idEtudiant, $isSimulation = false) {
    global $competenceLists;
    $listCompetence = GetArrayLine($competenceLists,$idCursus);
    if (!isset($listCompetence)){
        $listCompetence=GetCompetenceListFromCursus($idCursus);
        $competenceLists[]=array($idCursus,$listCompetence);
    }
    $notesEtudiant = array();
    $moyenne = 0;
    $sommecredits = 0;
    foreach ($listCompetence as $i => $competence) {
        $notesEtudiant[$i] = GetMoyenneFromCompetence($competence->GetId(), $idEtudiant, $isSimulation);
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

function GetTabNotesEtudiantsFromEpreuve($idEpreuve, $isSimulation = false) {
    global $listEtudiantsFromCursus;
    $notesEtudiants = array();
    foreach ($listEtudiantsFromCursus as $i => $etudiant) {
        $idEtudiant = $etudiant->GetId();
        $etudiantNote = GetEtudiantNoteFromEtudiantEpreuve($idEtudiant, $idEpreuve, $isSimulation);
        if (isset($etudiantNote)) {
            $absenceEtudiant = $etudiantNote->GetAbsence();
            if (($absenceEtudiant == 0) || ($absenceEtudiant == 2)) {
                $notesEtudiants[] = GetNoteSimulation($etudiantNote, $isSimulation);
            }
            else $notesEtudiants[] = -1;
        }
        else $notesEtudiants[] = -1;
    }
    return $notesEtudiants;
}

function GetTabNotesEtudiantsFromTypeEval($idTypeEval,$isSimulation = false) {
    $notesEtudiants = array();
    global $listEtudiantsFromCursus;
    foreach ($listEtudiantsFromCursus as $etudiant) {
        $notesEtudiants[] = GetMoyenneFromTypeEval($idTypeEval, $etudiant->GetId(), $isSimulation);
    }
    return $notesEtudiants;
}

function GetTabNotesEtudiantsFromEval($idEval, $isSimulation = false) {
    $notesEtudiants = array();
    global $listEtudiantsFromCursus;
    foreach ($listEtudiantsFromCursus as $etudiant) {
        $notesEtudiants[] = GetMoyenneFromEval($idEval, $etudiant->GetId(), $isSimulation);
    }
    return $notesEtudiants;
}

function GetTabNotesEtudiantsFromCours($idCours, $isSimulation = false) {
    $notesEtudiants = array();
    global $listEtudiantsFromCursus;
    foreach ($listEtudiantsFromCursus as $etudiant) {
        $notesEtudiants[] = GetMoyenneFromCours($idCours, $etudiant->GetId(), $isSimulation);
    }
    return $notesEtudiants;
}

function GetTabNotesEtudiantsFromCompetence($idCompetence, $isSimulation = false) {
    $notesEtudiants = array();
    global $listEtudiantsFromCursus;
    foreach ($listEtudiantsFromCursus as $etudiant) {
        $notesEtudiants[] = GetMoyenneFromCompetence($idCompetence, $etudiant->GetId(), $isSimulation);
    }
    return $notesEtudiants;
}

function GetTabNotesEtudiantsFromCursus($idCursus, $isSimulation = false) {
    $notesEtudiants = array();
    global $listEtudiantsFromCursus;
    foreach ($listEtudiantsFromCursus as $etudiant) {
        $notesEtudiants[] = GetMoyenneFromCursus($idCursus, $etudiant->GetId(), $isSimulation);
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
