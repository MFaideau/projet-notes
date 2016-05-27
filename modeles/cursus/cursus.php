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
    $req = $bdd->prepare('SELECT ID_Cursus, Nom_Cursus FROM Cursus');
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
