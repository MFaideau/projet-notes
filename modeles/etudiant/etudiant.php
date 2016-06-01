<?php
/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 25/05/2016
 * Time: 15:53
 */

include_once('etudiant.class.php');

function GetEtudiant($utilisateur)
{
    global $bdd;
    $userMail = $utilisateur->GetMail();
    $req = $bdd->prepare('SELECT etudiant.ID_Etudiant,etudiant.ID_Cursus,etudiant.Mail FROM etudiant,utilisateur WHERE etudiant.Mail=:mail');
    $req->bindParam(':mail', $userMail, PDO::PARAM_STR);
    $req->execute();
    $etudiantLine = $req->fetchAll();
    $cursus = GetCursus(GetCursusList(),$etudiantLine[0]["ID_Cursus"]);
    $etudiant = new Etudiant($etudiantLine,$cursus,$utilisateur);
    return $etudiant;
}