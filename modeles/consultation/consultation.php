<?php
include_once 'consultation.class.php';

function GetTopConsultations($mailConsultant, $topNumber)
{
    global $bdd;
    $req = $bdd->prepare('SELECT ID_Etudiant,Mail_Consultant,Nombre_Vues_Etudiant
FROM consultation WHERE Mail_Consultant = :mailConsultant ORDER BY Nombre_Vues_Etudiant DESC LIMIT :topNumber ');
    $req->bindParam(':mailConsultant', $mailConsultant, PDO::PARAM_STR);
    $req->bindParam(':topNumber', $topNumber, PDO::PARAM_INT);
    $req->execute();
    $topConsultations = $req->fetchAll();
    $listConsultations = array();
    foreach ($topConsultations as $consultation) {
        $listConsultations[] = new Consultation($consultation);
    }
    return $listConsultations;
}

function CurrentVues($mailConsultant, $idEtudiant)
{
    global $bdd;
    $req = $bdd->prepare('SELECT Nombre_Vues_Etudiant FROM consultation
WHERE ID_Etudiant = :idEtudiant AND Mail_Consultant = :mailConsultant');
    $req->bindParam(':idEtudiant', $idEtudiant, PDO::PARAM_INT);
    $req->bindParam(':mailConsultant', $mailConsultant, PDO::PARAM_STR);
    $req->execute();
    $matchCount = $req->fetchAll();
    if (count($matchCount) > 0)
        return $matchCount[0][0];
    else
        return -1;
}

function IncrementConsultation($mailConsultant, $idEtudiant)
{
    $currentVues = CurrentVues($mailConsultant, $idEtudiant);
    $nouvellesVues = $currentVues + 1;
    global $bdd;
    if ($currentVues == - 1) {
        $req = $bdd->prepare('INSERT INTO consultation (ID_Etudiant,Mail_Consultant,Nombre_Vues_Etudiant) 
VALUES (:idEtudiant,:mailConsultant,:nbVues)');
        $req->execute(array(
            ':mailConsultant' => $mailConsultant,
            ':idEtudiant' => $idEtudiant,
            ':nbVues' => 1,
        ));
    }
    else {
        $req = $bdd->prepare('UPDATE consultation SET Nombre_Vues_Etudiant=:nbVues 
WHERE Mail_Consultant = :mailConsultant AND ID_Etudiant = :idEtudiant');
        $req->execute(array(
            ':mailConsultant' => $mailConsultant,
            ':idEtudiant' => $idEtudiant,
            ':nbVues' => $nouvellesVues,
        ));
    }
}

function DeleteTopConsultation($mailConsultant) {
    global $bdd;
    $req = $bdd->prepare('DELETE FROM consultation WHERE Mail_Consultant = :mailConsultant');
    $result = $req->execute(array(
        'mailConsultant' => $mailConsultant,
    ));
    return $result;
}