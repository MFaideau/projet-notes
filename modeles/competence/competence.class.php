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

    function Competence($competenceLine)
    {
        $this->id=$competenceLine["ID_Competence"];
        $this->nom=$competenceLine["Nom_Competence"];
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