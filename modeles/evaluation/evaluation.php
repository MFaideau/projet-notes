<?php
/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 31/05/2016
 * Time: 08:12
 */
include_once (__DIR__ . '../../../modeles/type_evaluation/typeeval.class.php');
function GetTypeEvalListFromEval($evalId){
    $list =array();
    global $bdd;
    $req = $bdd->prepare('SELECT type_eval.ID_Type,type_eval.Nom_Type,type_eval.Coef_Type_Eval FROM type_eval
WHERE type_eval.ID_Eval=:idEval');
    $req->bindParam(':idEval', $evalId, PDO::PARAM_INT);
    $req->execute();
    $typeEvalList=$req->fetchAll();
    foreach($typeEvalList as $typeEval)
    {
        $list[]=new TypeEval($typeEval,false);
    }
    return $list;
}
function InsertEvaluation($nom,$coef,$idCours)
{
    global $bdd;
    $req = $bdd->prepare('INSERT INTO evaluation (Nom_Eval,Coef_Eval,ID_Cours) VALUES (:nom,:coef,:idCours)');
    $req->execute(array(
        'nom' => $nom,
        'coef' => $coef,
        'idCours' => $idCours,
    ));
    $req = $bdd->prepare('SELECT ID_Eval FROM evaluation ORDER BY ID_Eval DESC LIMIT 1');
    $req->execute();
    $lastEvalID= $req->fetch();
    return $lastEvalID[0];
}

function DeleteEval($id)
{
    global $bdd;
    $req = $bdd->prepare('DELETE FROM evaluation WHERE ID_Eval = :idEval');
    $req->execute(array(
        'idEval' => $id,
    ));
    return;
}

function ModifyEval($idEval,$nom,$coef)
{
    global $bdd;
    $req = $bdd->prepare('UPDATE evaluation SET Nom_Eval=:nom,Coef_Eval=:coef WHERE ID_Eval = :id');
    $req->execute(array(
        'nom' => $nom,
        'coef' => $coef,
        'id' => $idEval,
    ));
    return;
}