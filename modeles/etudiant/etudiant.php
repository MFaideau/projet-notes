<?php

include_once('etudiant.class.php');

function GetEtudiant($utilisateur)
{
    global $bdd;
    $userMail = $utilisateur->GetMail();
    $req = $bdd->prepare('SELECT etudiant.ID_Etudiant,etudiant.ID_Cursus,etudiant.Mail FROM etudiant WHERE etudiant.Mail=:mail');
    $req->bindParam(':mail', $userMail, PDO::PARAM_STR);
    $req->execute();
    $etudiantLine = $req->fetchAll();

    if (empty($etudiantLine))
        return null;
    else {
        $cursus = GetCursus(GetCursusList(), $etudiantLine[0]["ID_Cursus"]);
        $etudiant = new Etudiant($etudiantLine[0], $cursus, $utilisateur);
        return $etudiant;
    }
}

function InsertEtudiant($idCursus,$idEtudiant,$nom,$prenom,$mail)
{
    // Insère l'étudiant dans les utilisateurs également
    global $bdd;
    if(!UtilisateurExists($mail)) {
        InsertUser($nom, $prenom, $mail, 0);
    }
    $req = $bdd->prepare('INSERT INTO etudiant (ID_Etudiant,ID_Cursus,Mail) VALUES (:idEtudiant,:idCursus,:mail)');
    $result = $req->execute(array(
        'mail' => $mail,
        'idEtudiant' => $idEtudiant,
        'idCursus' => $idCursus,
    ));
    return $result;
}

function UtilisateurExists($mail)
{
    global $bdd;
    $req = $bdd->prepare('SELECT count(Mail) FROM utilisateur WHERE Mail = :mail');
    $req->bindParam(':mail', $mail, PDO::PARAM_STR);
    $req->execute();
    $matchCount = $req->fetch();
    if ($matchCount['count(Mail)'] > 0)
        return true;
    else
        return false;
}

function GetCursusIDFromEtudiant($idEtudiant)
{
    global $bdd;
    $req = $bdd->prepare('SELECT ID_Cursus FROM etudiant WHERE ID_Etudiant=:idEtudiant');
    $req->bindParam(':idEtudiant', $idEtudiant, PDO::PARAM_STR);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_COLUMN);
}

function GetCompetenceIDFromEtudiant($idEtudiant)
{
    global $bdd;
    $req = $bdd->prepare('SELECT ID_Competence FROM etudiant,competence WHERE competence.ID_Cursus=etudiant.ID_Cursus AND etudiant.ID_Etudiant=:idEtudiant');
    $req->bindParam(':idEtudiant', $idEtudiant, PDO::PARAM_STR);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_COLUMN);
}

function GetCoursIDFromEtudiant($idEtudiant)
{
    global $bdd;
    $req = $bdd->prepare('SELECT ID_Cours FROM etudiant,competence,cours WHERE cours.ID_Competence=competence.ID_Competence AND competence.ID_Cursus=etudiant.ID_Cursus AND etudiant.ID_Etudiant=:idEtudiant');
    $req->bindParam(':idEtudiant', $idEtudiant, PDO::PARAM_STR);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_COLUMN);
}