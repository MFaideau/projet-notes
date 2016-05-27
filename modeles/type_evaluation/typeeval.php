<?php
/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 27/05/2016
 * Time: 14:34
 */
include_once(__DIR__ . '../../epreuve/epreuve.class.php');

function GetEpreuveFromTypeEval($typeEvalId){
    $list =array();
    global $bdd;
    $req = $bdd->prepare('SELECT epreuve.ID_Epreuve,epreuve.Nom_Epreuve,epreuve.Coef_Epreuve,epreuve.Date_Epreuve,epreuve.Evaluateur_Epreuve
        FROM epreuve WHERE epreuve.ID_Type = :idType');
    $req->bindParam(':idType', $typeEvalId, PDO::PARAM_INT);
    $req->execute();
    $epreuveList=$req->fetchAll();
    foreach($epreuveList as $epreuve)
    {
        $list[]=new Epreuve($epreuve,false);
    }
    return $list;
}