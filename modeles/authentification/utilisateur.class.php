<?php

/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 25/05/2016
 * Time: 11:20
 */
include_once __DIR__ . '../../etudiant/etudiant.php';

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
    }

    public function GetMail()
    {
        return $this->mail;
    }
    public function GetAutorite()
    {
        return $this->autorite;
    }
    public function GetNom()
    {
        return $this->nom;
    }
    public function GetPrenom()
    {
        return $this->prenom;
    }
    public function GetCursusTexte()
    {
        if ($this->autorite == 0) {
            return GetEtudiant($this)->GetCursus()->GetNom();
        }
        else if ($this->autorite ==2) {
            return "Visiteur";
        }
        return "Administrateur";
    }
}
?>