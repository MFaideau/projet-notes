<?php

class Consultation
{
    private $idEtudiant;
    private $mailConsultant;
    private $nombreVues;

    function Consultation($consultationLine)
    {
        $this->idEtudiant = $consultationLine['ID_Etudiant'];
        $this->mailConsultant = $consultationLine['Mail_Consultant'];
        $this->nombreVues = $consultationLine['Nombre_Vues_Etudiant'];
    }

    function GetId() {
        return $this->idEtudiant;
    }
}