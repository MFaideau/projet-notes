<?php

/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 27/05/2016
 * Time: 11:53
 */
class TypeEval
{
    private $id;
    private $nom;
    private $coef;

    function TypeEval($typeEvalLine,$recursive)
    {
        $this->id=$typeEvalLine["ID_Type"];
        $this->nom=$typeEvalLine["Nom_Type"];
        $this->coef=$typeEvalLine["Coef_Type_Eval"];
        //if ($recursive ==true) {
        //    $this->typeEvalList=GetTypeEvalFromDB();
        //}
    }
}