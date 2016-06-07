<?php
/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 25/05/2016
 * Time: 14:30
 */

include_once('cursus.class.php');

function GetCompetenceListFromCursus($idCursus)
{
    $list =array();
    global $bdd;
    $req = $bdd->prepare('SELECT competence.ID_Competence,competence.Nom_Competence 
FROM competence WHERE competence.ID_Cursus=:idCursus');
    $req->bindParam(':idCursus', $idCursus, PDO::PARAM_INT);
    $req->execute();
    $competenceList=$req->fetchAll();
    foreach($competenceList as $competence)
    {
        $list[]=new Competence($competence,false);
    }
    return $list;
}
function GetCursusList()
{
    global $bdd;
    $req = $bdd->prepare('SELECT ID_Cursus, Nom_Cursus,Annee_Cursus FROM cursus');
    $req->execute();
    $cursusArray = $req->fetchAll();
    $cursusList = array();
    foreach ($cursusArray as $cursus)
    {
        $cursusList[] = new Cursus($cursus,true);
    }
    return $cursusList;
}

function GetCursus($list,$id)
{
    foreach($list as $cursus)
    {
        if ($cursus->GetId() == $id){
            return $cursus;
        }
    }
    return null;
}
function InsertCursus($nom,$annee)
{
    global $bdd;
    $req = $bdd->prepare('INSERT INTO cursus (Nom_Cursus,Annee_Cursus) VALUES (:nom,:annee)');
    $req->execute(array(
        'nom' => $nom,
        'annee' => $annee,
    ));
    $req = $bdd->prepare('SELECT ID_Cursus FROM cursus ORDER BY ID_Cursus DESC LIMIT 1');
    $req->execute();
    $lastCursusID= $req->fetch();
    return $lastCursusID[0];
}

function DeleteCursus($id)
{
    global $bdd;
    $req = $bdd->prepare('DELETE FROM cursus WHERE ID_Cursus = :idCursus');
    $req->execute(array(
        'idCursus' => $id,
    ));
    $req = $bdd->prepare('SELECT ID_Competence FROM competence WHERE ID_Cursus = :idCursus');
    $req->bindParam(':idCursus', $id, PDO::PARAM_INT);
    $req->execute();
    $idCompetences = $req->fetchAll();
    if (!empty($idCompetences))
    {
        foreach($idCompetences as $idCompetence)
        {
            DeleteCompetence($idCompetence[0]);
        }
    }
    return;
}

function ModifyCursus($id,$newName,$annee)
{
    global $bdd;
    $req = $bdd->prepare('UPDATE cursus SET Nom_Cursus=:nom, Annee_Cursus=:annee WHERE ID_Cursus = :id');
    $req->execute(array(
        'id' => $id,
        'nom' => $newName,
        'annee' => $annee,
    ));
    return;
}