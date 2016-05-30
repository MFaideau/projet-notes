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

function InsertCours($nom,$idCursus)
{
    global $bdd;
    $req = $bdd->prepare('INSERT INTO competence (Nom_Competence,ID_Cursus) VALUES (:nom,:idCursus)');
    $req->execute(array(
        'nom' => $nom,
        'idCursus' => $idCursus,
    ));
    $req = $bdd->prepare('SELECT ID_Competence FROM competence ORDER BY ID_Competence DESC LIMIT 1');
    $req->execute();
    $lastCompetenceID= $req->fetch();
    return $lastCompetenceID[0];
}

function DeleteCours($id)
{
    global $bdd;
    $req = $bdd->prepare('DELETE FROM competence WHERE ID_Competence = :idCompetence');
    $req->execute(array(
        'idCompetence' => $id,
    ));
    return;
}

function ModifyCours($id,$newName)
{
    global $bdd;
    $req = $bdd->prepare('UPDATE competence SET Nom_Competence=:nom WHERE ID_Competence = :id');
    $req->execute(array(
        'id' => $id,
        'nom' => $newName,
    ));
    return;
}