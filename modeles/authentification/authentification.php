<?php
/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 25/05/2016
 * Time: 10:52
 */
include_once('utilisateur.class.php');

function GetAdmins()
{
    $usersList = array();
    global $bdd;
    $req = $bdd->prepare('SELECT Mail,Nom,Prenom,Autorite FROM utilisateur WHERE autorite > 0');
    $req->execute();
    $users = $req->fetchAll();
    foreach($users as $user)
    {
        $usersList[] = new Utilisateur($user);
    }
    return $usersList;
}

function GetUser($mail)
{
    global $bdd;
    $req = $bdd->prepare('SELECT Mail,Nom,Prenom,Autorite FROM utilisateur WHERE utilisateur.Mail=:mail');
    $req->bindParam(':mail', $mail, PDO::PARAM_STR);
    $req->execute();
    $users = $req->fetchAll();
    if (empty($users))
        return null;
    else{
        $newUser=new Utilisateur($users[0]);
        return $newUser;
    }
}

function GetUserFromEtudiant($idEtudiant)
{
    global $bdd;
    $req = $bdd->prepare('SELECT utilisateur.Mail,utilisateur.Nom,utilisateur.Prenom,utilisateur.Autorite 
                          FROM utilisateur,etudiant WHERE utilisateur.Mail=etudiant.Mail AND etudiant.ID_Etudiant=:idEtudiant');
    $req->bindParam(':idEtudiant', $idEtudiant, PDO::PARAM_INT);
    $req->execute();
    $users = $req->fetchAll();
    if (empty($users))
        return null;
    else{
        $newUser=new Utilisateur($users[0]);
        return $newUser;
    }
}

function GetUsersFromCursus($idCursus)
{
    $usersList = array();
    global $bdd;
    $req = $bdd->prepare('SELECT utilisateur.Mail,utilisateur.Nom,utilisateur.Prenom,utilisateur.Autorite FROM utilisateur,etudiant WHERE utilisateur.Mail=etudiant.Mail
AND etudiant.ID_Cursus=:idCursus');
    $req->bindParam(':idCursus', $idCursus, PDO::PARAM_INT);
    $req->execute();
    $users = $req->fetchAll();
    foreach($users as $user)
    {
        $usersList[]=new Utilisateur($user);
    }
    return $usersList;
}

function GetUsersFromCompetence($idCompetence)
{
    $usersList = array();
    global $bdd;
    $req = $bdd->prepare('SELECT utilisateur.Mail,utilisateur.Nom,utilisateur.Prenom,utilisateur.Autorite FROM utilisateur,etudiant,cursus,competence WHERE utilisateur.Mail=etudiant.Mail
AND etudiant.ID_Cursus=cursus.ID_Cursus AND competence.ID_Cursus = cursus.ID_Cursus AND competence.ID_Competence = :idCompetence');
    $req->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
    $req->execute();
    $users = $req->fetchAll();
    foreach($users as $user)
    {
        $usersList[]=new Utilisateur($user);
    }
    return $usersList;
}

function GetUsersFromCours($idCours)
{
    $usersList = array();
    global $bdd;
    $req = $bdd->prepare('SELECT utilisateur.Mail,utilisateur.Nom,utilisateur.Prenom,utilisateur.Autorite FROM utilisateur,etudiant,cursus,competence,cours WHERE utilisateur.Mail=etudiant.Mail
AND etudiant.ID_Cursus=cursus.ID_Cursus AND competence.ID_Cursus = cursus.ID_Cursus AND competence.ID_Competence = cours.ID_Competence AND cours.ID_Cours = :idCours');
    $req->bindParam(':idCours', $idCours, PDO::PARAM_INT);
    $req->execute();
    $users = $req->fetchAll();
    foreach($users as $user)
    {
        $usersList[]=new Utilisateur($user);
    }
    return $usersList;
}

function GetUsersFromTypeEval($idTypeEval)
{
    $usersList = array();
    global $bdd;
    $req = $bdd->prepare('SELECT utilisateur.Mail,utilisateur.Nom,utilisateur.Prenom,utilisateur.Autorite FROM utilisateur,etudiant,cursus,competence,cours,evaluation,type_eval WHERE utilisateur.Mail=etudiant.Mail
AND etudiant.ID_Cursus=cursus.ID_Cursus AND competence.ID_Cursus = cursus.ID_Cursus AND competence.ID_Competence = cours.ID_Competence AND cours.ID_Cours = evaluation.ID_Cours AND evaluation.ID_Eval = type_eval.ID_Eval AND type_eval.ID_Type=:idType');
    $req->bindParam(':idType', $idTypeEval, PDO::PARAM_INT);
    $req->execute();
    $users = $req->fetchAll();
    foreach($users as $user)
    {
        $usersList[]=new Utilisateur($user);
    }
    return $usersList;
}

function GetUsersFromEpreuve($idEpreuve)
{
    $usersList = array();
    global $bdd;
    $req = $bdd->prepare('SELECT utilisateur.Mail,utilisateur.Nom,utilisateur.Prenom,utilisateur.Autorite FROM utilisateur,etudiant,cursus,competence,cours,evaluation,type_eval,epreuve WHERE utilisateur.Mail=etudiant.Mail
AND etudiant.ID_Cursus=cursus.ID_Cursus AND competence.ID_Cursus = cursus.ID_Cursus AND competence.ID_Competence = cours.ID_Competence AND cours.ID_Cours = evaluation.ID_Cours AND evaluation.ID_Eval = type_eval.ID_Eval AND type_eval.ID_Type=epreuve.ID_Type AND epreuve.ID_Epreuve=:idEpreuve');
    $req->bindParam(':idEpreuve', $idEpreuve, PDO::PARAM_INT);
    $req->execute();
    $users = $req->fetchAll();
    foreach($users as $user)
    {
        $usersList[]=new Utilisateur($user);
    }
    return $usersList;
}

function InsertUser($nom,$prenom,$mail,$autorite)
{
    global $bdd;
    $req = $bdd->prepare('INSERT INTO utilisateur (Mail,Nom,Prenom,Autorite) VALUES (:mail,:nom,:prenom,:autorite)');
    $req->execute(array(
        'mail' => $mail,
        'nom' => $nom,
        'prenom' => $prenom,
        'autorite' => $autorite,
    ));
    return;
}

function ModifyUser($mailOrigine,$nom,$prenom,$mail,$autorite)
{
    global $bdd;
    $req = $bdd->prepare('UPDATE utilisateur SET Mail=:mail,Nom=:nom,Prenom=:prenom,Autorite=:autorite
WHERE Mail=:mailOrigine');
    $req->execute(array(
        'mail' => $mail,
        'nom' => $nom,
        'prenom' => $prenom,
        'autorite' => $autorite,
        'mailOrigine' => $mailOrigine,
    ));
    return;
}

function DeleteUser($mail)
{
    global $bdd;
    $req = $bdd->prepare('DELETE FROM utilisateur WHERE Mail = :mail');
    $req->execute(array(
        'mail' => $mail,
    ));
    return;
}