<?php

/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 25/05/2016
 * Time: 15:08
 */
include_once('modeles/cursus/cursus.php');
include_once('modeles/authentification/authentification.php');

class Etudiant
{
    private $id;
    private $cursus;
    private $utilisateur;

    function Etudiant($etudiantLine,$cursus,$utilisateur)
    {
        $this->id=$etudiantLine[0]["ID_Etudiant"];
        $this->cursus=$cursus;
        $this->utilisateur=$utilisateur;
    }

    public function GetId()
    {
        return $this->id;
    }
    public function GetCursus()
    {
        return $this->cursus;
    }
    public function GetUtilisateur()
    {
        return $this->utilisateur;
    }
}
