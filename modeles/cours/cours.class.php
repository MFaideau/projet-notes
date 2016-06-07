<?php

/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 26/05/2016
 * Time: 14:30
 */
include_once (__DIR__ . '../../../modeles/evaluation/evaluation.class.php');
include_once (__DIR__ . '../../../modeles/cours/cours.php');
class Cours
{
    private $id;
    public $nom;
    public $credits;
    public $semestre;
    
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