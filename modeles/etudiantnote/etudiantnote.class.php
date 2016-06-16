<?php

/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 31/05/2016
 * Time: 10:25
 */
class EtudiantNote
{
    private $idEtudiant;
    private $idEpreuve;
    private $notePrevue;
    public $noteFinale;
    private $absence;

    function EtudiantNote($etudiantNoteLine)
    {
        $this->idEpreuve=$etudiantNoteLine["ID_Epreuve"];
        $this->idEtudiant=$etudiantNoteLine["ID_Etudiant"];
        $this->noteFinale=$etudiantNoteLine["Note_Finale"];
        $this->notePrevue=$etudiantNoteLine["Note_Prevue"];
        $this->absence=$etudiantNoteLine["Absence_Epreuve"];
    }
    public function GetIdEtudiant()
    {
        return $this->idEtudiant;
    }
    public function GetNoteFinale()
    {
        return $this->noteFinale;
    }
    public function GetNotePrevue()
    {
        return $this->notePrevue;
    }
    public function GetAbsence()
    {
        return $this->absence;
    }
}