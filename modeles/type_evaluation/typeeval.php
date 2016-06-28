<?php
/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 27/05/2016
 * Time: 14:34
 */

function GetTypeEvalFromId($typeEvalId){
    global $bdd;
    $req = $bdd->prepare('SELECT ID_Type,Nom_Type,Coef_Type_Eval
        FROM type_eval WHERE ID_Type = :idType');
    $req->bindParam(':idType', $typeEvalId, PDO::PARAM_INT);
    $req->execute();
    $typeEvalList=$req->fetchAll();
    if (count($typeEvalList) > 0)
        return new TypeEval($typeEvalList[0]);
    else
        return null;
}
function GetEpreuveListFromTypeEval($typeEvalId){
    $list =array();
    global $bdd;
    $req = $bdd->prepare('SELECT ID_Epreuve,ID_Epreuve_Substitution,ID_Epreuve_Session2,Nom_Epreuve,Coef_Epreuve,Date_Epreuve,Evaluateur_Epreuve
        FROM epreuve WHERE epreuve.ID_Type = :idType');
    $req->bindParam(':idType', $typeEvalId, PDO::PARAM_INT);
    $req->execute();
    $epreuveList=$req->fetchAll();
    foreach($epreuveList as $epreuve)
    {
        $list[]=new Epreuve($epreuve);
    }
    return $list;
}
function GetEpreuveSecondeSessionListFromTypeEval($typeEvalId){
    $list =array();
    global $bdd;
    $req = $bdd->prepare('SELECT ID_Epreuve,ID_Epreuve_Substitution,ID_Epreuve_Session2,Nom_Epreuve,Coef_Epreuve,Date_Epreuve,Evaluateur_Epreuve FROM epreuve WHERE epreuve.ID_Type = :idType AND epreuve.ID_Epreuve IN(SELECT ID_Epreuve_Session2 FROM epreuve WHERE epreuve.ID_Epreuve_Session2>0)');
    $req->bindParam(':idType', $typeEvalId, PDO::PARAM_INT);
    $req->execute();
    $epreuveList=$req->fetchAll();
    foreach($epreuveList as $epreuve)
    {
        $list[]=new Epreuve($epreuve);
    }
    return $list;
}

function InsertTypeEval($nom,$coef,$idEval)
{
    global $bdd;
    $reqSum = $bdd->prepare('SELECT Coef_Type_Eval FROM type_eval WHERE ID_Eval=:idEval');
    $reqSum->execute(array(
        'idEval' => $idEval,
    ));
    $sommeCoef =$coef;
    foreach($reqSum->fetchAll() as $coefDb){
        $sommeCoef+=$coefDb[0];
    }
    if ($sommeCoef > 1){
        return;
    }
    $req = $bdd->prepare('INSERT INTO type_eval (Nom_Type,Coef_Type_Eval,ID_Eval) VALUES (:nom,:coef,:idEval)');
    $req->execute(array(
        'nom' => $nom,
        'coef' => $coef,
        'idEval' => $idEval,
    ));
    $req = $bdd->prepare('SELECT ID_Type FROM type_eval ORDER BY ID_Type DESC LIMIT 1');
    $req->execute();
    $lastTypeEvalID= $req->fetch();
    return $lastTypeEvalID[0];
}

function InsertTypeEvalFull($data)
{
    global $bdd;
    $req = $bdd->prepare('INSERT INTO type_eval (ID_Type,ID_Eval,Nom_Type,Coef_Type_Eval) VALUES (:idType,:idEval,:nomType,:coefTypeEval)');
    $req->bindParam(':idType', $data[0], PDO::PARAM_INT);
    $req->bindParam(':idEval', $data[1], PDO::PARAM_INT);
    $req->bindParam(':nomType', $data[2], PDO::PARAM_STR);
    $req->bindParam(':coefTypeEval', $data[3], PDO::PARAM_STR);
    $req->execute();
}

function DeleteTypeEval($id)
{
    global $bdd;
    $req = $bdd->prepare('DELETE FROM type_eval WHERE ID_Type = :idType');
    $req->execute(array(
        'idType' => $id,
    ));
    $req = $bdd->prepare('SELECT ID_Epreuve FROM epreuve WHERE ID_Type = :idType');
    $req->bindParam(':idType', $id, PDO::PARAM_INT);
    $req->execute();
    $idEpreuves = $req->fetchAll();
    if (!empty($idEpreuves))
    {
        foreach($idEpreuves as $idEpreuve)
        {
            DeleteEpreuve($idEpreuve[0]);
        }
    }
    return;
}

function ModifyTypeEval($idTypeEval,$nom,$coef)
{
    global $bdd;
    $req = $bdd->prepare('UPDATE type_eval SET Nom_Type=:nom,Coef_Type_Eval=:coef WHERE ID_Type = :id');
    $req->execute(array(
        'nom' => $nom,
        'coef' => $coef,
        'id' => $idTypeEval,
    ));
    return;
}

function GetContentTypeEval($idCursus) {
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM cours,competence,evaluation,type_eval WHERE type_eval.ID_Eval=evaluation.ID_Eval AND evaluation.ID_Cours=cours.ID_Cours AND cours.ID_Competence=competence.ID_Competence
AND competence.ID_Cursus=:idCursus');
    $req->bindParam(':idCursus', $idCursus, PDO::PARAM_INT);
    $req->execute();
    $result=$req->fetchAll();
    $str="type_eval"."\r\n";
    $str =$str.count($result)."\r\n";
    //$str=$str."ID_Type;ID_Eval;Nom_Type;Coef_Type_Eval"."\r\n";
    foreach ($result as $line){
        $str=$str.$line["ID_Type"].";";
        $str=$str.$line["ID_Eval"].";";
        $str=$str.$line["Nom_Type"].";";
        $str=$str.$line["Coef_Type_Eval"]."\r\n";
    }
    return $str;
}

function CopyTypeEval($idTypeEval,$idEval)
{
    global $bdd;
    $req = $bdd->prepare('SELECT Nom_Type,Coef_Type_Eval FROM type_eval WHERE ID_Type=:idType');
    $req->bindParam(':idType', $idTypeEval, PDO::PARAM_INT);
    $req->execute();
    $result=$req->fetchAll();
    if (count($result)>0)
    {
        $idTypeEvalNew= InsertTypeEval($result[0]["Nom_Type"],$result[0]["Coef_Type_Eval"],$idEval);
        foreach(GetEpreuveListFromTypeEval($idTypeEval) as $epreuve)
        {
            CopyEpreuve($epreuve->GetId(), $idTypeEvalNew);
        }
        return $idTypeEvalNew;
    }
}