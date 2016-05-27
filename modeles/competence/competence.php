<?php
/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 27/05/2016
 * Time: 10:49
 */
include_once(__DIR__ . '../../cours/cours.class.php');

function GetCoursList($idCompetence)
{
    $list =array();
    global $bdd;
    $req = $bdd->prepare('SELECT cours.ID_Cours,cours.Nom_Cours,cours.Credits_Cours,cours.Semestre_Cours
        FROM cours WHERE cours.ID_Competence=:idCompetence');
    $req->bindParam(':idCompetence', $this->id, PDO::PARAM_INT);
    $req->execute();
    $coursList=$req->fetchAll();
    foreach($coursList as $cours) {
        $list[] = new Cours($cours,false);
    }
    return $list;
}