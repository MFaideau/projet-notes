<?php
/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 27/05/2016
 * Time: 11:10
 */
include_once(__DIR__ . '../../type_evaluation/typeeval.class.php');
function GetTypeEvalListFromCours($idCours)
{
    $list =array();
    global $bdd;
    $req = $bdd->prepare('SELECT type_eval.ID_Type,type_eval.Nom_Type,type_eval.Coef_Type_Eval FROM evaluation,type_eval
WHERE type_eval.ID_Eval=evaluation.ID_Eval AND evaluation.ID_Cours = :idCours');
    $req->bindParam(':idCours', $idCours, PDO::PARAM_INT);
    $req->execute();
    $typeEvalList=$req->fetchAll();
    foreach($typeEvalList as $typeEval)
    {
        $list[]=new TypeEval($typeEval,false);
    }
    return $list;
}