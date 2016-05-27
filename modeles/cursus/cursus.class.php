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
    private $id;
    private $nom;
    private $competenceList;

    function Cursus($cursusLine)
    {
        $this->id=$cursusLine["ID_Cursus"];
        $this->nom=$cursusLine["Nom_Cursus"];
        $this->competenceList = $this->GetCompetenceListFromDB();
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
    public function GetCompetenceListFromDB()
    {
        $cursusId = $this->id;
        $list =array();
        global $bdd;
        $req = $bdd->prepare('SELECT competence.ID_Competence,competence.Nom_Competence 
FROM competence,competencecursus 
WHERE competencecursus.ID_Cursus=:idCursus 
AND competencecursus.ID_Competence=competence.ID_Competence');
        $req->bindParam(':idCursus', $cursusId, PDO::PARAM_INT);
        $req->execute();
        $competenceList=$req->fetchAll();
        foreach($competenceList as $competence)
        {
            $list[]=new Competence($competence);
        }
        return $list;
    }

}