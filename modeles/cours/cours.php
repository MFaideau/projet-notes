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
        $list[]=new TypeEval($typeEval);
    }
    return $list;
}
function GetEvalListFromCours($idCours)
{
    $list =array();
    global $bdd;
    $req = $bdd->prepare('SELECT evaluation.ID_Eval,evaluation.Nom_Eval,evaluation.Coef_Eval FROM evaluation
WHERE evaluation.ID_Cours = :idCours');
    $req->bindParam(':idCours', $idCours, PDO::PARAM_INT);
    $req->execute();
    $evalList=$req->fetchAll();
    foreach($evalList as $eval) {
        $list[] = new Evaluation($eval);
    }
    return $list;
}
function InsertCours($nom,$ects,$semestre,$idCompetence)
{
    global $bdd;
    $req = $bdd->prepare('INSERT INTO cours (Nom_Cours,Credits_Cours,Semestre_Cours,ID_Competence) VALUES (:nom,:creditsCours,:semestreCours,:idCompetence)');
    $req->execute(array(
        'nom' => $nom,
        'creditsCours' => $ects,
        'semestreCours' => $semestre,
        'idCompetence' => $idCompetence,
    ));
    $req = $bdd->prepare('SELECT ID_Cours FROM cours ORDER BY ID_Cours DESC LIMIT 1');
    $req->execute();
    $lastCoursID= $req->fetch();
    return $lastCoursID[0];
}

function DeleteCours($id)
{
    global $bdd;
    $req = $bdd->prepare('DELETE FROM cours WHERE ID_Cours = :idCours');
    $req->execute(array(
        'idCours' => $id,
    ));
    $req = $bdd->prepare('SELECT ID_Eval FROM evaluation WHERE ID_Cours = :idCours');
    $req->bindParam(':idCours', $id, PDO::PARAM_INT);
    $req->execute();
    $idEvals = $req->fetchAll();
    if (!empty($idEvals))
    {
        foreach($idEvals as $idEval)
        {
            DeleteEval($idEval[0]);
        }
    }
    return;
}

function ModifyCours($idCours,$nom,$ects,$semestre)
{
    global $bdd;
    $req = $bdd->prepare('UPDATE cours SET Nom_Cours=:nom,Credits_Cours=:credits,Semestre_Cours=:semestre WHERE ID_Cours = :id');
    $req->execute(array(
        'nom' => $nom,
        'credits' => $ects,
        'semestre' => $semestre,
        'id' => $idCours,
    ));
    return;
}

function GetCoursById($idCours) {
    global $bdd;
    $req = $bdd->prepare('SELECT ID_Cours, Nom_Cours, Credits_Cours, Semestre_Cours FROM cours WHERE ID_Cours = :id');
    $req->bindParam(':id', $idCours, PDO::PARAM_INT);
    $req->execute();
    return new Cours($req->fetchAll()[0]);
}