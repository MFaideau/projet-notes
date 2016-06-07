<?php

/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 27/05/2016
 * Time: 11:53
 */
include_once (__DIR__ . '../../../modeles/epreuve/epreuve.class.php');
include_once (__DIR__ . '../../../modeles/type_evaluation/typeeval.php');
class TypeEval
{
    private $id;
    public $nom;
    public $coef;

    function TypeEval($typeEvalLine)
    {
        $this->id=$typeEvalLine["ID_Type"];
        $this->nom=$typeEvalLine["Nom_Type"];
        $this->coef=$typeEvalLine["Coef_Type_Eval"];
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
    public function GetMoyenneEtudiant($idEtudiant)
    {
        $sommeCoef = 0.0;
        $moyenne = 0.0;
        foreach($this->epreuves as $epreuve)
        {
            $moyenneEpreuve = $epreuve->GetNoteEtudiant($idEtudiant);
            $coefEpreuve = $epreuve->GetCoef();
            if ($moyenneEpreuve != -1)
            {
                $moyenne=$moyenne + $moyenneEpreuve*$coefEpreuve;
                $sommeCoef = $sommeCoef+$coefEpreuve;
            }
        }
        if ($sommeCoef == 0)
        {
            return -1;
        }
        else
        {
            return $moyenne/$sommeCoef;
        }
    }
}