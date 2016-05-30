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

function DeleteCursus($id)
{
    global $bdd;
    $req = $bdd->prepare('DELETE FROM cursus WHERE ID_Cursus = :idCursus');
    $req->execute(array(
        'idCursus' => $id,
    ));
}

function RenameCursus($id,$newName)
{
    global $bdd;
    $req = $bdd->prepare('UPDATE cursus SET column1=value, column2=value2,... WHERE some_column=some_value ');
    
}