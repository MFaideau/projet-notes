<?php
/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 27/05/2016
 * Time: 11:10
 */
include_once(__DIR__ . '../../type_evaluation/typeeval.class.php');
include_once(__DIR__ . '../../competence/competence.php');
function GetCompetenceFromCours($idCours)
{
    global $bdd;
    $req = $bdd->prepare('SELECT competence.ID_Competence,competence.Nom_Competence 
FROM competence,cours WHERE competence.ID_Competence=cours.ID_Competence
AND cours.ID_Cours = :idCours');
    $req->bindParam(':idCours', $idCours, PDO::PARAM_INT);
    $req->execute();
    $competence=$req->fetchAll();
    if (empty($competence))
        return null;
    else
        return new Competence($competence[0]);
}

function GetEpreuveListFromCours($idCours)
{
    $list =array();
    global $bdd;
    $req = $bdd->prepare('SELECT ID_Epreuve,ID_Epreuve_Substitution,ID_Epreuve_Session2,Nom_Epreuve,Coef_Epreuve,Date_Epreuve,Evaluateur_Epreuve
        FROM epreuve,type_eval,evaluation WHERE epreuve.ID_Type = type_eval.ID_Type AND type_eval.ID_Eval = evaluation.ID_Eval
        AND evaluation.ID_Cours = :idCours');
    $req->bindParam(':idCours', $idCours, PDO::PARAM_INT);
    $req->execute();
    $epreuveList=$req->fetchAll();
    foreach($epreuveList as $epreuve)
    {
        $list[]=new Epreuve($epreuve);
    }
    return $list;
}

function GetTypeEvalListFromCours($idCours)
{
    $list = array();
    global $bdd;
    $req = $bdd->prepare('SELECT type_eval.ID_Type,type_eval.Nom_Type,type_eval.Coef_Type_Eval FROM evaluation,type_eval
WHERE type_eval.ID_Eval=evaluation.ID_Eval AND evaluation.ID_Cours = :idCours');
    $req->bindParam(':idCours', $idCours, PDO::PARAM_INT);
    $req->execute();
    $typeEvalList=$req->fetchAll();
    foreach($typeEvalList as $typeEval)
    {
        $list[]=new TypeEval($typeEval);
    }
    return $list;
}
function GetEvalListFromCours($idCours)
{
    $list =array();
    global $bdd;
    $req = $bdd->prepare('SELECT evaluation.ID_Eval,evaluation.Nom_Eval,evaluation.Coef_Eval FROM evaluation
WHERE evaluation.ID_Cours = :idCours');
    $req->bindParam(':idCours', $idCours, PDO::PARAM_INT);
    $req->execute();
    $evalList=$req->fetchAll();
    foreach($evalList as $eval) {
        $list[] = new Evaluation($eval);
    }
    return $list;
}
function InsertCours($nom,$ects,$semestre,$idCompetence)
{
    global $bdd;
    $req = $bdd->prepare('INSERT INTO cours (Nom_Cours,Credits_Cours,Semestre_Cours,ID_Competence) VALUES (:nom,:creditsCours,:semestreCours,:idCompetence)');
    $req->execute(array(
        'nom' => $nom,
        'creditsCours' => $ects,
        'semestreCours' => $semestre,
        'idCompetence' => $idCompetence,
    ));
    $req = $bdd->prepare('SELECT ID_Cours FROM cours ORDER BY ID_Cours DESC LIMIT 1');
    $req->execute();
    $lastCoursID= $req->fetch();
    return $lastCoursID[0];
}

function InsertCoursFull($data)
{
    global $bdd;
    $req = $bdd->prepare('INSERT INTO cours (ID_Cours,ID_Competence,Nom_Cours,Credits_Cours,Semestre_Cours) VALUES (:idCours,:idCompetence,:nomCours,:creditsCours,:semestreCours)');
    $req->bindParam(':idCours', $data[0], PDO::PARAM_INT);
    $req->bindParam(':idCompetence', $data[1], PDO::PARAM_INT);
    $req->bindParam(':nomCours', $data[2], PDO::PARAM_STR);
    $req->bindParam(':creditsCours', $data[3], PDO::PARAM_STR);
    $req->bindParam(':semestreCours', $data[4], PDO::PARAM_INT);
    $req->execute();
}

function DeleteCours($id)
{
    global $bdd;
    $req = $bdd->prepare('DELETE FROM cours WHERE ID_Cours = :idCours');
    $req->execute(array(
        'idCours' => $id,
    ));
    $req = $bdd->prepare('SELECT ID_Eval FROM evaluation WHERE ID_Cours = :idCours');
    $req->bindParam(':idCours', $id, PDO::PARAM_INT);
    $req->execute();
    $idEvals = $req->fetchAll();
    if (!empty($idEvals))
    {
        foreach($idEvals as $idEval)
        {
            DeleteEval($idEval[0]);
        }
    }
    return;
}

function ModifyCours($idCours,$nom,$ects,$semestre)
{
    global $bdd;
    $req = $bdd->prepare('UPDATE cours SET Nom_Cours=:nom,Credits_Cours=:credits,Semestre_Cours=:semestre WHERE ID_Cours = :id');
    $req->execute(array(
        'nom' => $nom,
        'credits' => $ects,
        'semestre' => $semestre,
        'id' => $idCours,
    ));
    return;
}

function GetCoursById($idCours) {
    global $bdd;
    $req = $bdd->prepare('SELECT ID_Cours, Nom_Cours, Credits_Cours, Semestre_Cours FROM cours WHERE ID_Cours = :id');
    $req->bindParam(':id', $idCours, PDO::PARAM_INT);
    $req->execute();
    return new Cours($req->fetchAll()[0]);
}

function GetContentCours($idCursus) {
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM cours,competence WHERE cours.ID_Competence=competence.ID_Competence
AND competence.ID_Cursus=:idCursus');
    $req->bindParam(':idCursus', $idCursus, PDO::PARAM_INT);
    $req->execute();
    $result=$req->fetchAll();
    $str="cours"."\r\n";
    $str =$str.count($result)."\r\n";
    //$str=$str."ID_Cours;ID_Competence;Nom_Cours;Credits_Cours;Semestre_Cours"."\r\n";
    foreach ($result as $line){
        $str=$str.$line["ID_Cours"].";";
        $str=$str.$line["ID_Competence"].";";
        $str=$str.$line["Nom_Cours"].";";
        $str=$str.$line["Credits_Cours"].";";
        $str=$str.$line["Semestre_Cours"]."\r\n";
    }
    return $str;
}

function GetMoyenneCoursEtudiant($idCours,$idEtudiant)
{
    global $bdd;
    $req = $bdd->prepare('SELECT Moyenne FROM coursmoyenne WHERE ID_Cours=:idCours AND ID_Etudiant=:idEtudiant');
    $req->bindParam(':idCours', $idCours, PDO::PARAM_INT);
    $req->bindParam(':idEtudiant', $idEtudiant, PDO::PARAM_INT);
    $req->execute();
    $result=$req->fetch()['Moyenne'];
    return $result;
}

function InsertMoyenneCoursEtudiant($idCours,$idEtudiant,$moyenne)
{
    global $bdd;
    $req = $bdd->prepare('INSERT INTO coursmoyenne (ID_Cours,ID_Etudiant,Moyenne) VALUES (:idCours,:idEtudiant,:moyenne)');
    $req->execute(array(
        'idCours' => $idCours,
        'idEtudiant' => $idEtudiant,
        'moyenne'=> $moyenne,
    ));
    return;
}

function InsertMoyenneCours($idCours)
{
    global $bdd;
    $req = $bdd->prepare('SELECT ID_Etudiant FROM etudiant,competence,cours WHERE competence.ID_Cursus=etudiant.ID_Cursus AND
competence.ID_Competence=cours.ID_Competence AND cours.ID_Cours=:idCours');
    $req->bindParam(':idCours', $idCours, PDO::PARAM_INT);
    $req->execute();
    $result=$req->fetchAll(PDO::FETCH_COLUMN);
    foreach($result as $etudiant)
    {
        InsertMoyenneCoursEtudiant($idCours, $etudiant, -1);
    }
}
function UpdateMoyenneCoursEtudiant($idCours,$idEtudiant,$moyenne)
{
    global $bdd;
    $req = $bdd->prepare('UPDATE coursmoyenne SET Moyenne=:moyenne WHERE ID_Cours=:idCours AND ID_Etudiant=:idEtudiant');
    $req->execute(array(
        'idCours' => $idCours,
        'idEtudiant' => $idEtudiant,
        'moyenne' => $moyenne,
    ));
    return;
}

function GetBDDTabNotesMoyenneCours($idCours)
{
    global $bdd;
    $req = $bdd->prepare('SELECT Moyenne FROM coursmoyenne WHERE ID_Cours=:idCours ORDER BY Moyenne DESC');
    $req->bindParam(':idCours', $idCours, PDO::PARAM_INT);
    $req->execute();
    $result=$req->fetchAll(PDO::FETCH_COLUMN);
    return $result;
}