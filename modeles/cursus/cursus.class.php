<?php

/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 25/05/2016
 * Time: 14:24
 */
class Cursus
{
    private $id;
    private $nom;

    function Cursus($cursusLine)
    {
        $this->id=$cursusLine["ID_Cursus"];
        $this->nom=$cursusLine["Nom_Cursus"];
    }
    public function GetId()
    {
        return $this->id;
    }

}