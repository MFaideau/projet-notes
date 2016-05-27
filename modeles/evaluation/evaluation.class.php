<?php

/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 27/05/2016
 * Time: 09:25
 */
class Evaluation
{
    private $id;
    private $nom;
    private $coef;

    function Evaluation($evalLine,$recursive)
    {
        $this->id=$evalLine["ID_Eval"];
        $this->nom=$evalLine["Nom_Eval"];
        $this->coef=$evalLine["Coef_Eval"];
    }
}