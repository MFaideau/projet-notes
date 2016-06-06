<?php

/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 25/05/2016
 * Time: 14:24
 */
include_once(__DIR__ . '../../competence/competence.class.php');
class Cursus
{
    public $id;
    public $nom;
    private $competenceList;
    public $annee;

    function Cursus($cursusLine,$recursive)
    {
        $this->id=$cursusLine["ID_Cursus"];
        $this->nom=$cursusLine["Nom_Cursus"];
        $this->annee=$cursusLine["Annee_Cursus"];
        if ($recursive ==true) {
            $this->competenceList = $this->GetCompetenceListFromDB();
        }
    }
    public function GetId()
    {
        return $this->id;
    }
    public function GetNom()
    {
        return $this->nom;
    }
    public function GetCompetenceList()
    {
        return $this->competenceList;
    }
    public function GetAnnee()
    {
        return $this->annee;
    }
    public function GetCompetenceListFromDB()
    {
        $cursusId = $this->id;
        $list =array();
        global $bdd;
        $req = $bdd->prepare('SELECT competence.ID_Competence,competence.Nom_Competence 
FROM competence WHERE competence.ID_Cursus=:idCursus');
        $req->bindParam(':idCursus', $cursusId, PDO::PARAM_INT);
        $req->execute();
        $competenceList=$req->fetchAll();
        foreach($competenceList as $competence)
        {
            $list[]=new Competence($competence,false);
        }
        return $list;
    }

}