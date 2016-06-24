<?php
/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 31/05/2016
 * Time: 08:49
 */


function GetEpreuveFromId($epreuveId){
    global $bdd;
    $req = $bdd->prepare('SELECT ID_Epreuve,ID_Epreuve_Substitution,ID_Epreuve_Session2,Nom_Epreuve,Coef_Epreuve,Date_Epreuve,Evaluateur_Epreuve
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
    $reqSum = $bdd->prepare('SELECT Coef_Epreuve FROM epreuve WHERE ID_Type=:idType');
    $reqSum->execute(array(
        'idType' => $idTypeEval,
    ));
    $sommeCoef =$coef;
    foreach($reqSum->fetchAll() as $coefDb){
        $sommeCoef+=$coefDb[0];
    }
    if ($sommeCoef > 1){
        return;
    }
    $req = $bdd->prepare('INSERT INTO epreuve (Nom_Epreuve,Coef_Epreuve,Date_Epreuve,Evaluateur_Epreuve,ID_Type,ID_Epreuve_Substitution,ID_Epreuve_Session2) 
VALUES (:nom,:coef,:dateEpreuve,:evaluateur,:idType,:idEpreuveSubstitution,:idSession2)');
    $req->execute(array(
        'nom' => $nom,
        'coef' => $coef,
        'dateEpreuve' => $dateEpreuve,
        'evaluateur' => $evaluateur,
        'idType' => $idTypeEval,
        'idEpreuveSubstitution' => $idEpreuveSubstitution,
        'idSession2' => $idSecondeSession,
    ));
    $req = $bdd->prepare('SELECT ID_Epreuve FROM epreuve ORDER BY ID_Epreuve DESC LIMIT 1');
    $req->execute();
    $lastEpreuveID= $req->fetch();
    return $lastEpreuveID[0];
}

function InsertEpreuveFull($data)
{
    global $bdd;
    $req = $bdd->prepare('INSERT INTO epreuve (ID_Epreuve,ID_Type,ID_Epreuve_Session2,ID_Epreuve_Substitution,Nom_Epreuve,Coef_Epreuve,Date_Epreuve,Evaluateur_Epreuve) VALUES (:idEpreuve,:idType,:idEpreuveSession2,:idEpreuveSubstitution,:nomEpreuve,:coefEpreuve,:dateEpreuve,:evaluateurEpreuve)');
    $req->bindParam(':idEpreuve', $data[0], PDO::PARAM_INT);
    $req->bindParam(':idType', $data[1], PDO::PARAM_INT);
    $req->bindParam(':idEpreuveSession2', $data[2], PDO::PARAM_INT);
    $req->bindParam(':idEpreuveSubstitution', $data[3], PDO::PARAM_INT);
    $req->bindParam(':nomEpreuve', $data[4], PDO::PARAM_STR);
    $req->bindParam(':coefEpreuve', $data[5], PDO::PARAM_STR);
    $req->bindParam(':dateEpreuve', $data[6], PDO::PARAM_STR);
    $req->bindParam(':evaluateurEpreuve', $data[7], PDO::PARAM_STR);
    $req->execute();
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
    $req = $bdd->prepare('UPDATE epreuve SET Nom_Epreuve=:nom,Coef_Epreuve=:coef,Date_Epreuve=:dateEpreuve,Evaluateur_Epreuve=:evaluateur,ID_Epreuve_Substitution=:idSubstitution,ID_Epreuve_Session2=:idSession2 WHERE ID_Epreuve = :id');
    $req->execute(array(
        'id' => $idEpreuve,
        'nom' => $nom,
        'coef' => $coef,
        'dateEpreuve' => $dateEpreuve,
        'evaluateur' => $evaluateur,
        'idSubstitution' => $idEpreuveSubstitution,
        'idSession2' => $idSecondeSession,
    ));
    return;
}

function GetContentEpreuve($idCursus) {
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM cours,competence,evaluation,type_eval,epreuve WHERE type_eval.ID_Type=epreuve.ID_Type AND type_eval.ID_Eval=evaluation.ID_Eval AND evaluation.ID_Cours=cours.ID_Cours AND cours.ID_Competence=competence.ID_Competence
AND competence.ID_Cursus=:idCursus');
    $req->bindParam(':idCursus', $idCursus, PDO::PARAM_INT);
    $req->execute();
    $result=$req->fetchAll();
    $str="epreuve"."\r\n";
    $str =$str.count($result)."\r\n";
    //$str=$str."ID_Epreuve;ID_Type;ID_Epreuve_Session2;ID_Epreuve_Substitution;Nom_Epreuve;Coef_Epreuve;Date_Epreuve;Evaluateur_Epreuve"."\r\n";
    foreach ($result as $line){
        $str=$str.$line["ID_Epreuve"].";";
        $str=$str.$line["ID_Type"].";";
        $str=$str.$line["ID_Epreuve_Session2"].";";
        $str=$str.$line["ID_Epreuve_Substitution"].";";
        $str=$str.$line["Nom_Epreuve"].";";
        $str=$str.$line["Coef_Epreuve"].";";
        $str=$str.$line["Date_Epreuve"].";";
        $str=$str.$line["Evaluateur_Epreuve"]."\r\n";
    }
    return $str;
}

function GetCursusIdFromEpreuveId($idEpreuve){
    global $bdd;
    $req = $bdd->prepare('SELECT ID_Cursus FROM competence,cours,evaluation,type_eval,epreuve WHERE competence.ID_Competence=cours.ID_Competence 
AND cours.ID_Cours=evaluation.ID_Cours AND evaluation.ID_Eval=type_eval.ID_Eval AND type_eval.ID_Type=epreuve.ID_Type AND epreuve.ID_Epreuve=:idEpreuve');
    $req->bindParam(':idEpreuve', $idEpreuve, PDO::PARAM_INT);
    $req->execute();
    $result=$req->fetchAll(PDO::FETCH_COLUMN);
    if (empty($result)){
        return 0;
    }
    else{
        return $result[0];
    }
}

function GetCompetenceIdFromEpreuveId($idEpreuve){
    global $bdd;
    $req = $bdd->prepare('SELECT ID_Competence FROM cours,evaluation,type_eval,epreuve WHERE cours.ID_Cours=evaluation.ID_Cours AND evaluation.ID_Eval=type_eval.ID_Eval AND type_eval.ID_Type=epreuve.ID_Type 
AND epreuve.ID_Epreuve=:idEpreuve');
    $req->bindParam(':idEpreuve', $idEpreuve, PDO::PARAM_INT);
    $req->execute();
    $result=$req->fetchAll(PDO::FETCH_COLUMN);
    if (empty($result)){
        return 0;
    }
    else{
        return $result[0];
    }
}

function GetCoursIdFromEpreuveId($idEpreuve){
    global $bdd;
    $req = $bdd->prepare('SELECT ID_Cours FROM evaluation,type_eval,epreuve WHERE evaluation.ID_Eval=type_eval.ID_Eval AND type_eval.ID_Type=epreuve.ID_Type 
AND epreuve.ID_Epreuve=:idEpreuve');
    $req->bindParam(':idEpreuve', $idEpreuve, PDO::PARAM_INT);
    $req->execute();
    $result=$req->fetchAll(PDO::FETCH_COLUMN);
    if (empty($result)){
        return 0;
    }
    else{
        return $result[0];
    }
}