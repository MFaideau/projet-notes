<?php

/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 27/05/2016
 * Time: 14:14
 */
include_once (__DIR__ . '../../../modeles/epreuve/epreuve.php');
include_once (__DIR__ . '../../../modeles/etudiantnote/etudiantnote.php');
class epreuve
{
    private $id;
    private $nom;
    private $coef;
    private $date;
    private $evaluateur;
    private $idSubstition;

    function Epreuve($epreuveLine)
    {
        $this->id=$epreuveLine["ID_Epreuve"];
        $this->nom=$epreuveLine["Nom_Epreuve"];
        $this->coef=$epreuveLine["Coef_Epreuve"];
        $this->date=$epreuveLine["Date_Epreuve"];
        $this->evaluateur=$epreuveLine["Evaluateur_Epreuve"];
        $this->idSubstition=$epreuveLine["ID_Epreuve_Substitution"];
    }
    public function GetSecondeSessionID()
    {
        
    }
    public function GetMoyennePresents()
    {
        $etudiantNotes = GetEtudiantNotesFromEpreuve($this->id);
        $count=0;
        $somme = 0.0;
        foreach($etudiantNotes as $etudiantNote)
        {
            if ($etudiantNote->GetAbsence() == 0) // Présent
            {
                $somme = $somme + $etudiantNote->GetNoteFinale();
                $count++;
            }
        }
        if ($count ==0)
        {
            return -1;
        }
        else
        {
            return ($somme)/($count);
        }
    }
    public function GetMoyenne()
    {
        $etudiantNotes = GetEtudiantNotesFromEpreuve($this->id);
        $count=0;
        $somme = 0.0;
        foreach($etudiantNotes as $etudiantNote)
        {
            if ($etudiantNote->GetAbsence() != 1) // Présent ou absent non excusé
            {
                if ($etudiantNote->GetAbsence() == 0) // Présent
                {
                    $somme = $somme + $etudiantNote->GetNoteFinale();
                }
                $count++;
            }
        }
        if ($count ==0)
        {
            return -1;
        }
        else
        {
            return ($somme)/($count);
        }
    }
    public function GetNoteEtudiant($idEtudiant)
    { // RETOURNE LA NOTE (EN NUMERIQUE) ET NON L'OBJET
        $etudiantNote = GetEtudiantNoteFromEtudiantEpreuve($idEtudiant,$this->id);
        if (!isset($etudiantNote))
        { // Note pas encore entrée.
            return -1;
        }
        elseif ($etudiantNote->GetAbsence() == 0)
        {
            return $etudiantNote->GetNoteFinale();
        }
        elseif ($etudiantNote->GetAbsence() == 1)
        { // Malade, on ne comptera pas la note dans le calcul de la moyenne.
            if ($this->idSubstition <= 0)
            {
                return -1;
            }
            else
            {
                $substituteEpreuve = GetEpreuveFromId($this->idSubstition);
                if (isset($substituteEpreuve))
                {
                    return $substituteEpreuve->GetNoteEtudiant($idEtudiant);
                }
                else
                {
                    return -1;
                }
            }
        }
        elseif ($etudiantNote->GetAbsence() == 2)
        { // A seché l'interro, ce sera zéro.
            return 0;
        }
    }
    public function GetId()
    {
        return $this->id;
    }
    public function GetNom()
    {
        return $this->nom;
    }
    public function GetCoef()
    {
        return $this->coef;
    }
    public function GetDate()
    {
        return $this->date;
    }
    public function GetEvaluateur()
    {
        return $this->evaluateur;
    }
    public function GetIdSubstition()
    {
        return $this->idSubstition;
    }
}
