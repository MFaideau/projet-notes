<?php

/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 27/05/2016
 * Time: 14:14
 */
include_once (__DIR__ . '../../../modeles/epreuve/epreuve.php');
include_once (__DIR__ . '../../../modeles/etudiantnote/etudiantnote.php');
class epreuve
{
    public $id;
    public $nom;
    private $coef;
    private $date;
    private $evaluateur;
    private $idSubstition;
    private $idSecondeSession;

    function Epreuve($epreuveLine)
    {
        $this->id=$epreuveLine["ID_Epreuve"];
        $this->nom=$epreuveLine["Nom_Epreuve"];
        $this->coef=$epreuveLine["Coef_Epreuve"];
        $this->date=$epreuveLine["Date_Epreuve"];
        $this->evaluateur=$epreuveLine["Evaluateur_Epreuve"];
        $this->idSubstition=$epreuveLine["ID_Epreuve_Substitution"];
        $this->idSecondeSession=0;
        //On trouve l'ID de la seconde session
        global $bdd;
        $req = $bdd->prepare('SELECT ID_Epreuve_Session2 FROM epreuvesession WHERE ID_Epreuve_Session1=:s1');
        $req->bindParam(':s1', $this->id, PDO::PARAM_INT);
        $req->execute();
        $idSecondeSession=$req->fetchAll();
        if (!empty($idSecondeSession))
        {
            $this->idSecondeSession=$idSecondeSession[0][0];
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
    public function GetCoef()
    {
        return $this->coef;
    }
    public function GetDate()
    {
        return $this->date;
    }
    public function GetEvaluateur()
    {
        return $this->evaluateur;
    }
    public function GetIdSubstition()
    {
        return $this->idSubstition;
    }
    public function GetIdSecondeSession()
    {
        return $this->idSecondeSession;
    }
}
