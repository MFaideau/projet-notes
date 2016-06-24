<?php
/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 31/05/2016
 * Time: 08:12
 */
include_once (__DIR__ . '../../../modeles/type_evaluation/typeeval.class.php');

function GetEvalFromId($evalId){
    global $bdd;
    $req = $bdd->prepare('SELECT ID_Eval,Nom_Eval,Coef_Eval
        FROM evaluation WHERE evaluation.ID_Eval = :idEval');
    $req->bindParam(':idEval', $evalId, PDO::PARAM_INT);
    $req->execute();
    $evalList=$req->fetchAll();
    if (count($evalList) > 0)
        return new Evaluation($evalList[0]);
    else
        return null;
}

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
        $list[]=new TypeEval($typeEval);
    }
    return $list;
}

function InsertEvaluation($nom,$coef,$idCours)
{
    global $bdd;
    $reqSum = $bdd->prepare('SELECT Coef_Eval FROM evaluation WHERE ID_Cours=:idCours');
    $reqSum->execute(array(
        'idCours' => $idCours,
    ));
    $sommeCoef =$coef;
    foreach($reqSum->fetchAll() as $coefDb){
        $sommeCoef+=$coefDb[0];
    }
    if ($sommeCoef > 1){
        return;
    }
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

function InsertEvaluationFull($data)
{
    global $bdd;
    $req = $bdd->prepare('INSERT INTO evaluation (ID_Eval,ID_Cours,Nom_Eval,Coef_Eval) VALUES (:idEval,:idCours,:nomEval,:coefEval)');
    $req->bindParam(':idEval', $data[0], PDO::PARAM_INT);
    $req->bindParam(':idCours', $data[1], PDO::PARAM_INT);
    $req->bindParam(':nomEval', $data[2], PDO::PARAM_STR);
    $req->bindParam(':coefEval', $data[3], PDO::PARAM_STR);
    $req->execute();
}

function DeleteEval($id){
    global $bdd;
    $req = $bdd->prepare('DELETE FROM evaluation WHERE ID_Eval = :idEval');
    $req->execute(array(
        'idEval' => $id,
    ));
    $req = $bdd->prepare('SELECT ID_Type FROM type_eval WHERE ID_Eval = :idEval');
    $req->bindParam(':idEval', $id, PDO::PARAM_INT);
    $req->execute();
    $idTypes = $req->fetchAll();
    if (!empty($idTypes)) {
        foreach ($idTypes as $idType) {
            DeleteTypeEval($idType[0]);
        }
    }
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

function GetContentEval($idCursus) {
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM cours,competence,evaluation WHERE evaluation.ID_Cours=cours.ID_Cours AND cours.ID_Competence=competence.ID_Competence
AND competence.ID_Cursus=:idCursus');
    $req->bindParam(':idCursus', $idCursus, PDO::PARAM_INT);
    $req->execute();
    $result=$req->fetchAll();
    $str="evaluation"."\r\n";
    $str =$str.count($result)."\r\n";
    //$str=$str."ID_Eval;ID_Cours;Nom_Eval;Coef_Eval"."\r\n";
    foreach ($result as $line){
        $str=$str.$line["ID_Eval"].";";
        $str=$str.$line["ID_Cours"].";";
        $str=$str.$line["Nom_Eval"].";";
        $str=$str.$line["Coef_Eval"]."\r\n";
    }
    return $str;
}