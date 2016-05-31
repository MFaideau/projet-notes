<?php
/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 27/05/2016
 * Time: 10:49
 */
include_once(__DIR__ . '../../cours/cours.class.php');

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
        $list[] = new Cours($cours,false);
    }
    return $list;
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