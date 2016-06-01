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
    private $typeEvalList;

    function Evaluation($evalLine,$recursive)
    {
        $this->id=$evalLine["ID_Eval"];
        $this->nom=$evalLine["Nom_Eval"];
        $this->coef=$evalLine["Coef_Eval"];
        if ($recursive ==true) {
            $this->typeEvalList=$this->GetTypeEvalFromDB();
        }
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
    public function GetTypeEvalFromDB()
    {
        $list =array();
        global $bdd;
        $req = $bdd->prepare('SELECT type_eval.ID_Type,type_eval.Nom_Type,type_eval.Coef_Type_Eval FROM type_eval
WHERE type_eval.ID_Eval=:idEval');
        $req->bindParam(':idEval', $this->id, PDO::PARAM_INT);
        $req->execute();
        $typeEvalList=$req->fetchAll();
        foreach($typeEvalList as $typeEval)
        {
            $list[]=new TypeEval($typeEval,true);
        }
        return $list;
    }
    public function GetTypeEvalList()
    {
        return $this->typeEvalList;
    }

}