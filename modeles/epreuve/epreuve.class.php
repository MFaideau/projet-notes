<?php

/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 27/05/2016
 * Time: 14:14
 */
class epreuve
{
    private $id;
    private $nom;
    private $coef;
    private $date;
    private $evaluateur;

    function Epreuve($epreuveLine,$recursive)
    {
        $this->id=$epreuveLine["ID_Epreuve"];
        $this->nom=$epreuveLine["Nom_Epreuve"];
        $this->coef=$epreuveLine["Coef_Epreuve"];
        $this->date=$epreuveLine["Date_Epreuve"];
        $this->evaluateur=$epreuveLine["Evaluateur_Epreuve"];
        //if ($recursive ==true) {
        //    $this->epreuves=GetEpreuvesFromDB();
        //}
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
}
