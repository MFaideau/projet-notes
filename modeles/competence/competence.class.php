<?php

/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 26/05/2016
 * Time: 13:47
 */
include_once __DIR__ . '../../cours/cours.class.php';

class Competence
{
    private $id;
    private $nom;
    private $coursList;

    function Competence($competenceLine)
    {
        $this->id=$competenceLine["ID_Competence"];
        $this->nom=$competenceLine["Nom_Competence"];
        $this->coursList=$this->GetCoursFromDB();
    }

    public function GetCoursList()
    {
        return $this->coursList;
    }
    public function GetCoursFromDB()
    {
        $list =array();
        global $bdd;
        $req = $bdd->prepare('SELECT cours.ID_Cours,cours.Nom_Cours,cours.Credits_Cours,cours.Semestre_Cours
        FROM cours WHERE cours.ID_Competence=:idCompetence');
        $req->bindParam(':idCompetence', $this->id, PDO::PARAM_INT);
        $req->execute();
        $coursList=$req->fetchAll();
        foreach($coursList as $cours) {
            $list[] = new Cours($cours);
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