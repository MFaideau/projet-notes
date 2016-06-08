<?php

/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 25/05/2016
 * Time: 14:24
 */
include_once(__DIR__ . '../../competence/competence.class.php');
class Cursus
{
    public $id;
    public $nom;
    public $annee;
    public $credits;

    function Cursus($cursusLine)
    {
        $this->id=$cursusLine["ID_Cursus"];
        $this->nom=$cursusLine["Nom_Cursus"];
        $this->annee=$cursusLine["Annee_Cursus"];
        $this->credits = GetCreditsFromCursus($this->id);
    }

    public function GetCredits() {
        return $this->credits;
    }

    public function GetId()
    {
        return $this->id;
    }
    public function GetNom()
    {
        return $this->nom;
    }
    public function GetAnnee()
    {
        return $this->annee;
    }
}