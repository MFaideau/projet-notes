<?php
/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 26/05/2016
 * Time: 13:54
 */
include_once('competence.class.php');

function GetCompetenceList($cursusId)
{
    //$cursusId = $cursus->GetId();
    $list =array();
    global $bdd;
    $req = $bdd->prepare('SELECT competence.ID_Competence,competence.Nom_Competence 
FROM competence,competencecursus 
WHERE competencecursus.ID_Cursus=:idCursus 
AND competencecursus.ID_Competence=competence.ID_Competence');
    $req->bindParam(':idCursus', $cursusId, PDO::PARAM_INT);
    $req->execute();
    $competenceList=$req->fetchAll();
    foreach($competenceList as $competence)
    {
        $list[]=new Competence($competence);
    }
    return $list;
}