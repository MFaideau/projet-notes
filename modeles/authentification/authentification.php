<?php
/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 25/05/2016
 * Time: 10:52
 */
include_once('utilisateur.class.php');

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

function GetUsersFromCursus($idCursus)
{
    $usersList = array();
    global $bdd;
    $req = $bdd->prepare('SELECT utilisateur.Mail,Nom,Prenom,Autorite FROM utilisateur,etudiant WHERE utilisateur.Mail=etudiant.Mail
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

function DeleteUser($mail)
{
    global $bdd;
    $req = $bdd->prepare('DELETE FROM utilisateur WHERE Mail = :mail');
    $req->execute(array(
        'mail' => $mail,
    ));
    return;
}