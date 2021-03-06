<?php

/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 25/05/2016
 * Time: 15:08
 */
include_once (__DIR__ . '../../../modeles/cursus/cursus.php');
include_once (__DIR__ . '../../../modeles/authentification/authentification.php');

class Etudiant
{
    private $id;
    private $cursus;
    private $utilisateur;

    function Etudiant($etudiantLine,$cursus,$utilisateur)
    {
        $this->cursus=$cursus;
        $this->id=$etudiantLine["ID_Etudiant"];
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
