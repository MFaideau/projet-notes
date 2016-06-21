<?php
/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 27/05/2016
 * Time: 10:49
 */
include_once(__DIR__ . '../../cours/cours.class.php');

function GetCompetenceById($idCompetence)
{
    global $bdd;
    $req = $bdd->prepare('SELECT competence.ID_Competence,competence.Nom_Competence 
FROM competence WHERE competence.ID_Competence=:idCompetence');
    $req->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
    $req->execute();
    $competenceList=$req->fetchAll();
    if (empty($competenceList))
        return null;
    else
        return new Competence($competenceList[0]);
}
function GetCoursListFromCompetence($idCompetence)
{
    $list =array();
    global $bdd;
    $req = $bdd->prepare('SELECT cours.ID_Cours,cours.Nom_Cours,cours.Credits_Cours,cours.Semestre_Cours 
        FROM cours WHERE cours.ID_Competence=:idCompetence');
    $req->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
    $req->execute();
    $coursList=$req->fetchAll();
    foreach($coursList as $cours) {
        $list[] = new Cours($cours);
    }
    return $list;
}

function GetCreditsFromCompetence($idCompetence) {
    global $bdd;
    $req = $bdd->prepare('SELECT SUM(cours.Credits_Cours) FROM cours WHERE cours.ID_Competence=:idCompetence');
    $req->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
    $req->execute();
    $totalCredits = $req->fetch()[0];
    return $totalCredits;
}

function InsertCompetence($nom,$idCursus)
{
    global $bdd;
    $req = $bdd->prepare('INSERT INTO competence (Nom_Competence,ID_Cursus) VALUES (:nom,:idCursus)');
    $req->execute(array(
        'nom' => $nom,
        'idCursus' => $idCursus,
    ));
    $req = $bdd->prepare('SELECT ID_Competence FROM competence ORDER BY ID_Competence DESC LIMIT 1');
    $req->execute();
    $lastCompetenceID= $req->fetch();
    return $lastCompetenceID[0];
}

function DeleteCompetence($id)
{
    global $bdd;
    $req = $bdd->prepare('DELETE FROM competence WHERE ID_Competence = :idCompetence');
    $req->execute(array(
        'idCompetence' => $id,
    ));
    $req = $bdd->prepare('SELECT ID_Cours FROM cours WHERE ID_Competence = :idCompetence');
    $req->bindParam(':idCompetence', $id, PDO::PARAM_INT);
    $req->execute();
    $idCourss = $req->fetchAll();
    if (!empty($idCourss))
    {
        foreach($idCourss as $idCours)
        {
            DeleteCours($idCours[0]);
        }
    }
    return;
}

function ModifyCompetence($id,$newName)
{
    global $bdd;
    $req = $bdd->prepare('UPDATE competence SET Nom_Competence=:nom WHERE ID_Competence = :id');
    $req->execute(array(
        'id' => $id,
        'nom' => $newName,
    ));
    return;
}

function GetContentCompetence($idCursus) {
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM competence WHERE ID_Cursus=:idCursus');
    $req->bindParam(':idCursus', $idCursus, PDO::PARAM_INT);
    $req->execute();
    $result=$req->fetchAll();
    $str="competence"."\r\n";
    $str =$str.count($result)."\r\n";
    $str=$str."ID_Competence;ID_Cursus;Nom_Competence"."\r\n";
    foreach ($result as $line){
        $str=$str.$line["ID_Competence"].";";
        $str=$str.$line["ID_Cursus"].";";
        $str=$str.$line["Nom_Competence"]."\r\n";
    }
    return $str;
}