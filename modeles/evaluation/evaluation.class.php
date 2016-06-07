<?php

/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 27/05/2016
 * Time: 09:25
 */
include_once (__DIR__ . '../../../modeles/evaluation/evaluation.php');
include_once (__DIR__ . '../../../modeles/type_evaluation/typeeval.class.php');
class Evaluation
{
    private $id;
    private $nom;
    private $coef;

    function Evaluation($evalLine)
    {
        $this->id=$evalLine["ID_Eval"];
        $this->nom=$evalLine["Nom_Eval"];
        $this->coef=$evalLine["Coef_Eval"];
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
}