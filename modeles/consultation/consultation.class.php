<?php

/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 10/06/2016
 * Time: 08:42
 */
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
}