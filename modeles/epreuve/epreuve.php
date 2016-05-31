<?php
/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 31/05/2016
 * Time: 08:49
 */
function InsertEpreuve($nom,$coef,$dateEpreuve,$evaluateur,$idTypeEval)
{
    global $bdd;
    $req = $bdd->prepare('INSERT INTO epreuve (Nom_Epreuve,Coef_Epreuve,Date_Epreuve,Evaluateur_Epreuve,ID_Type) 
VALUES (:nom,:coef,:dateEpreuve,:evaluateur,:idType)');
    $req->execute(array(
        'nom' => $nom,
        'coef' => $coef,
        'dateEpreuve' => $dateEpreuve,
        'evaluateur' => $evaluateur,
        'idType' => $idTypeEval,
    ));
    $req = $bdd->prepare('SELECT ID_Epreuve FROM epreuve ORDER BY ID_Epreuve DESC LIMIT 1');
    $req->execute();
    $lastEpreuveID= $req->fetch();
    return $lastEpreuveID[0];
}

function DeleteEpreuve($id)
{
    global $bdd;
    $req = $bdd->prepare('DELETE FROM epreuve WHERE ID_Epreuve = :idEpreuve');
    $req->execute(array(
        'idEpreuve' => $id,
    ));
    return;
}

function ModifyEpreuve($idEpreuve,$nom,$coef,$dateEpreuve,$evaluateur)
{
    global $bdd;
    $req = $bdd->prepare('UPDATE epreuve SET Nom_Epreuve=:nom,Coef_Epreuve=:coef,Date_Epreuve=:dateEpreuve,Evaluateur_Epreuve=:evaluateur WHERE ID_Epreuve = :id');
    $req->execute(array(
        'id' => $idEpreuve,
        'nom' => $nom,
        'coef' => $coef,
        'dateEpreuve' => $dateEpreuve,
        'evaluateur' => $evaluateur,
    ));
    return;
}