<?php

/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 25/05/2016
 * Time: 11:20
 */
class Utilisateur
{
    private $mail;
    private $autorite;
    private $nom;
    private $prenom;

    function Utilisateur($user)
    {
        $this->mail=$user["Mail"];
        $this->autorite=$user["Autorite"];
        $this->nom=$user["Nom"];
        $this->prenom=$user["Prenom"];
        echo $this->mail;
        echo $this->autorite;
        echo $this->nom;
        echo $this->prenom;
    }
}
?>