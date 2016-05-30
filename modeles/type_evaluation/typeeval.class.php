<?php

/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 27/05/2016
 * Time: 11:53
 */
include_once (__DIR__ . '../../../modeles/epreuve/epreuve.class.php');
class TypeEval
{
    private $id;
    private $nom;
    private $coef;
    private $epreuves;

    function TypeEval($typeEvalLine,$recursive)
    {
        $this->id=$typeEvalLine["ID_Type"];
        $this->nom=$typeEvalLine["Nom_Type"];
        $this->coef=$typeEvalLine["Coef_Type_Eval"];
        if ($recursive ==true) {
            $this->epreuves=$this->GetEpreuvesFromDB();
        }
    }
    public function GetEpreuvesFromDB()
    {
        $list =array();
        global $bdd;
        $req = $bdd->prepare('SELECT epreuve.ID_Epreuve,epreuve.Nom_Epreuve,epreuve.Coef_Epreuve,epreuve.Date_Epreuve,epreuve.Evaluateur_Epreuve
        FROM epreuve WHERE epreuve.ID_Type = :idType');
        $req->bindParam(':idType', $this->id, PDO::PARAM_INT);
        $req->execute();
        $epreuveList=$req->fetchAll();
        foreach($epreuveList as $epreuve)
        {
            $list[]=new Epreuve($epreuve,true);
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
    public function GetCoef()
    {
        return $this->coef;
    }
}