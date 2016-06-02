<?php
/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 27/05/2016
 * Time: 14:34
 */

function GetEpreuveListFromTypeEval($typeEvalId){
    $list =array();
    global $bdd;
    $req = $bdd->prepare('SELECT epreuve.ID_Epreuve,epreuve.ID_Epreuve_Substitution,epreuve.Nom_Epreuve,epreuve.Coef_Epreuve,epreuve.Date_Epreuve,epreuve.Evaluateur_Epreuve
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

function InsertTypeEval($nom,$coef,$idEval)
{
    global $bdd;
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

function DeleteTypeEval($id)
{
    global $bdd;
    $req = $bdd->prepare('DELETE FROM type_eval WHERE ID_Type = :idType');
    $req->execute(array(
        'idType' => $id,
    ));
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