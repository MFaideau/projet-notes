<?php
/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 25/05/2016
 * Time: 14:30
 */

include_once('cursus.class.php');

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

