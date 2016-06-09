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
    public $id;
    public $nom;
    public $coef;
    public $date;
    public $evaluateur;
    public $idSubstition;
    public $idSecondeSession;

    function Epreuve($epreuveLine)
    {
        $this->id=$epreuveLine["ID_Epreuve"];
        $this->nom=$epreuveLine["Nom_Epreuve"];
        $this->coef=$epreuveLine["Coef_Epreuve"];
        $this->date=$epreuveLine["Date_Epreuve"];
        $this->evaluateur=$epreuveLine["Evaluateur_Epreuve"];
        $this->idSubstition=$epreuveLine["ID_Epreuve_Substitution"];
        $this->idSecondeSession=$epreuveLine["ID_Epreuve_Session2"];
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
    public function GetIdSecondeSession()
    {
        return $this->idSecondeSession;
    }
}
