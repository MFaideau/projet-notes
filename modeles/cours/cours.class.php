<?php

/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 26/05/2016
 * Time: 14:30
 */
class Cours
{
    private $id;
    private $nom;
    private $credits;
    private $semestre;
    
    function Cours($coursLine)
    {
        $this->id=$coursLine["ID_Cours"];
        $this->nom=$coursLine["Nom_Cours"];
        $this->credits=$coursLine["Credits_Cours"];
        $this->semestre=$coursLine["Semestre_Cours"];
    }
    public function GetId()
    {
        return $this->id;
    }
    public function GetNom()
    {
        return $this->nom;
    }
    public function GetCredits()
    {
        return $this->credits;
    }
    public function GetSemestre()
    {
        return $this->semestre;
    }
}