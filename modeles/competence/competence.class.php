<?php

/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 26/05/2016
 * Time: 13:47
 */
include_once(__DIR__ . '../../cours/cours.class.php');
include_once(__DIR__ . '../../competence/competence.php');
class Competence
{
    private $id;
    private $nom;
    private $coursList;

    function Competence($competenceLine,$recursive)
    {
        $this->id=$competenceLine["ID_Competence"];
        $this->nom=$competenceLine["Nom_Competence"];
        if ($recursive ==true) {
            $this->coursList=$this->GetCoursListFromDB();
        }
    }
    public function GetCoursList()
    {
        return $this->coursList;
    }
    public function GetCoursListFromDB()
    {
        $list =array();
        global $bdd;
        $req = $bdd->prepare('SELECT cours.ID_Cours,cours.Nom_Cours,cours.Credits_Cours,cours.Semestre_Cours
        FROM cours WHERE cours.ID_Competence=:idCompetence');
        $req->bindParam(':idCompetence', $this->id, PDO::PARAM_INT);
        $req->execute();
        $coursList=$req->fetchAll();
        foreach($coursList as $cours) {
            $list[] = new Cours($cours,true);
        }
        return $list;
    }
    public function GetId()
    {
        return $this->id;
    }
    public function GetNom()
    {
        return $this->nom;
    }
}