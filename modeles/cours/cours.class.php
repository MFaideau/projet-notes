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
    private $nom;
    private $credits;
    private $semestre;
    private $evaluationList;
    
    function Cours($coursLine,$recursive)
    {
        $this->id=$coursLine["ID_Cours"];
        $this->nom=$coursLine["Nom_Cours"];
        $this->credits=$coursLine["Credits_Cours"];
        $this->semestre=$coursLine["Semestre_Cours"];
        if ($recursive ==true) {
            $this->evaluationList=$this->GetEvaluationListFromDB();          
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
    public function GetCredits()
    {
        return $this->credits;
    }
    public function GetSemestre()
    {
        return $this->semestre;
    }
    public function GetEvaluationList()
    {
        return $this->evaluationList;
    }
    public function GetEvaluationListFromDB()
    {
        $list =array();
        global $bdd;
        $req = $bdd->prepare('SELECT evaluation.ID_Eval,evaluation.Nom_Eval,evaluation.Coef_Eval FROM evaluation
WHERE evaluation.ID_Eval = :idCours');
        $req->bindParam(':idCours', $this->id, PDO::PARAM_INT);
        $req->execute();
        $evalList=$req->fetchAll();
        foreach($evalList as $eval) {
            $list[] = new Evaluation($eval,true);
        }
        return $list;
    }
}