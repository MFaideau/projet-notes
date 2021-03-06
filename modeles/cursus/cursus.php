<?php
/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 25/05/2016
 * Time: 14:30
 */

include_once('cursus.class.php');

function GetEtudiantListFromCursus($cursus)
{
    $idCursus =$cursus->GetId();
    $list = array();
    global $bdd;
    $req = $bdd->prepare('SELECT ID_Etudiant,ID_Cursus FROM etudiant WHERE ID_Cursus=:idCursus');
    $req->bindParam(':idCursus', $idCursus, PDO::PARAM_INT);
    $req->execute();
    $etudiantLines = $req->fetchAll();
    foreach($etudiantLines as $etudiantLine)
    {
        $list[] = new Etudiant($etudiantLine,$cursus,null);
    }
    return $list;
}

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
        $list[]=new Competence($competence);
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
        $cursusList[] = new Cursus($cursus);
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

function InsertCursusFull($data)
{
    global $bdd;
    $req = $bdd->prepare('INSERT INTO cursus (ID_Cursus,Nom_Cursus,Annee_Cursus) VALUES (:idCursus,:nomCursus,:anneeCursus)');
    $req->bindParam(':idCursus', $data[0], PDO::PARAM_INT);
    $req->bindParam(':nomCursus', $data[1], PDO::PARAM_STR);
    $req->bindParam(':anneeCursus', $data[2], PDO::PARAM_INT);
    $req->execute();
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

function GetCreditsFromCursus($idCursus) {
    global $bdd;
    $req = $bdd->prepare('SELECT SUM(cours.Credits_Cours) FROM cours,competence,cursus WHERE cours.ID_Competence = competence.ID_Competence AND cursus.ID_Cursus = competence.ID_Cursus AND cursus.ID_Cursus = :idCursus');
    $req->bindParam(':idCursus', $idCursus, PDO::PARAM_INT);
    $req->execute();
    return $req->fetch()[0];
}

function GetContentAllCursus() {
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM cursus');
    $req->execute();
    $result=$req->fetchAll();
    $str="cursus"."\r\n";
    $str =$str.count($result)."\r\n";
    //$str=$str."ID_Cursus;Nom_Cursus;Annee_Cursus"."\r\n";
    foreach ($result as $line){
        $str=$str.$line["ID_Cursus"].";";
        $str=$str.$line["Nom_Cursus"].";";
        $str=$str.$line["Annee_Cursus"]."\r\n";
    }
    return $str;
}

function GetMoyenneCursusEtudiant($idCursus,$idEtudiant)
{
    global $bdd;
    $req = $bdd->prepare('SELECT Moyenne FROM cursusmoyenne WHERE ID_Cursus=:idCursus AND ID_Etudiant=:idEtudiant');
    $req->bindParam(':idCursus', $idCursus, PDO::PARAM_INT);
    $req->bindParam(':idEtudiant', $idEtudiant, PDO::PARAM_INT);
    $req->execute();
    $result=$req->fetch()['Moyenne'];
    return $result;
}

function InsertMoyenneCursus($idCursus)
{
    global $bdd;
    $req = $bdd->prepare('SELECT ID_Etudiant FROM etudiant WHERE etudiant.ID_Cursus = :idCursus');
    $req->bindParam(':idCursus', $idCursus, PDO::PARAM_INT);
    $req->execute();
    $result=$req->fetchAll(PDO::FETCH_COLUMN);
    foreach($result as $etudiant)
    {
        InsertMoyenneCursusEtudiant($idCursus, $etudiant, -1);
    }
}

function InsertMoyenneCursusEtudiant($idCursus,$idEtudiant,$moyenne)
{
    global $bdd;
    $req = $bdd->prepare('INSERT INTO cursusmoyenne (ID_Cursus,ID_Etudiant,Moyenne) VALUES (:idCursus,:idEtudiant,:moyenne)');
    $req->execute(array(
        'idCursus' => $idCursus,
        'idEtudiant' => $idEtudiant,
        'moyenne'=> $moyenne,
    ));
    return;
}

function InsertMoyenneCursusEtudiantList($list)
{
    global $bdd;
    $req = $bdd->prepare('INSERT INTO cursusmoyenne (ID_Cursus,ID_Etudiant,Moyenne) VALUES (:idCursus,:idEtudiant,:moyenne)');
    foreach($list as $cursusMoyenne){
        $req->execute(array(
            'idCursus' => $cursusMoyenne[0],
            'idEtudiant' => $cursusMoyenne[1],
            'moyenne'=> $cursusMoyenne[2],
        ));
    }
    return;
}

function UpdateMoyenneCursusEtudiant($idCursus,$idEtudiant,$moyenne)
{
    global $bdd;
    $req = $bdd->prepare('UPDATE cursusmoyenne SET Moyenne=:moyenne WHERE ID_Cursus=:idCursus AND ID_Etudiant=:idEtudiant');
    $req->execute(array(
        'idCursus' => $idCursus,
        'idEtudiant' => $idEtudiant,
        'moyenne' => $moyenne,
    ));
    return;
}

function GetBDDTabNotesMoyenneCursus($idCursus)
{
    global $bdd;
    $req = $bdd->prepare('SELECT Moyenne FROM cursusmoyenne WHERE ID_Cursus=:idCursus ORDER BY Moyenne DESC');
    $req->bindParam(':idCursus', $idCursus, PDO::PARAM_INT);
    $req->execute();
    $result=$req->fetchAll(PDO::FETCH_COLUMN);
    return $result;
}

function CopyCursus($idCursus)
{
    global $bdd;
    $req = $bdd->prepare('SELECT Nom_Cursus,Annee_Cursus FROM cursus WHERE ID_Cursus=:idCursus');
    $req->bindParam(':idCursus', $idCursus, PDO::PARAM_INT);
    $req->execute();
    $result=$req->fetchAll();
    if (count($result)>0)
    {
        $idCursusNew= InsertCursus($result[0]["Nom_Cursus"],$result[0]["Annee_Cursus"]);
        foreach(GetCompetenceListFromCursus($idCursus) as $competence)
        {
            CopyCompetence($competence->GetId(),$idCursusNew);
        }
        return $idCursusNew;
    }
}