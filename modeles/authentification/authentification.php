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