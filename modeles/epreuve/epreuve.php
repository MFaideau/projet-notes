<?php
/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 31/05/2016
 * Time: 08:49
 */
function GetEpreuveFromId($epreuveId){
    global $bdd;
    $req = $bdd->prepare('SELECT epreuve.ID_Epreuve,epreuve.ID_Epreuve_Substitution,epreuve.Nom_Epreuve,epreuve.Coef_Epreuve,epreuve.Date_Epreuve,epreuve.Evaluateur_Epreuve
        FROM epreuve WHERE epreuve.ID_Epreuve = :idEpreuve');
    $req->bindParam(':idEpreuve', $epreuveId, PDO::PARAM_INT);
    $req->execute();
    $epreuveList=$req->fetchAll();
    if (count($epreuveList) > 0)
    {
        return new Epreuve($epreuveList[0]);
    }
    else{
        return null;
    }
}

function InsertEpreuve($nom,$coef,$dateEpreuve,$evaluateur,$idEpreuveSubstitution,$idSecondeSession,$idTypeEval)
{
    global $bdd;
    $req = $bdd->prepare('INSERT INTO epreuve (Nom_Epreuve,Coef_Epreuve,Date_Epreuve,Evaluateur_Epreuve,ID_Type,ID_Epreuve_Substitution) 
VALUES (:nom,:coef,:dateEpreuve,:evaluateur,:idType,:idEpreuveSubstitution)');
    $req->execute(array(
        'nom' => $nom,
        'coef' => $coef,
        'dateEpreuve' => $dateEpreuve,
        'evaluateur' => $evaluateur,
        'idType' => $idTypeEval,
        'idEpreuveSubstitution' => $idEpreuveSubstitution,
    ));
    $req = $bdd->prepare('SELECT ID_Epreuve FROM epreuve ORDER BY ID_Epreuve DESC LIMIT 1');
    $req->execute();
    $lastEpreuveID= $req->fetch();
    if ($idSecondeSession > 0)
    {
        $req = $bdd->prepare('INSERT INTO epreuvesession (ID_Epreuve_Session1,ID_Epreuve_Session2) VALUES (:s1,:s2)');
        $req->execute(array(
        's1' => $lastEpreuveID[0],
        's2' => $idSecondeSession,
        ));
    }
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

function ModifyEpreuve($idEpreuve,$nom,$coef,$dateEpreuve,$evaluateur,$idEpreuveSubstitution,$idSecondeSession)
{
    global $bdd;
    $req = $bdd->prepare('UPDATE epreuve SET Nom_Epreuve=:nom,Coef_Epreuve=:coef,Date_Epreuve=:dateEpreuve,Evaluateur_Epreuve=:evaluateur,ID_Epreuve_Substitution=:idSubstitution WHERE ID_Epreuve = :id');
    $req->execute(array(
        'id' => $idEpreuve,
        'nom' => $nom,
        'coef' => $coef,
        'dateEpreuve' => $dateEpreuve,
        'evaluateur' => $evaluateur,
        'idSubstitution' => $idEpreuveSubstitution,
    ));
    $req = $bdd->prepare('UPDATE epreuvesession SET ID_Epreuve_Session2=:s2 WHERE ID_Epreuve_Session1 = :s1');
    $req->execute(array(
        's1' => $idEpreuve,
        's2' => $idSecondeSession,
    ));
    return;
}