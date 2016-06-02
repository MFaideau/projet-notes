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
