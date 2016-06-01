<?php
/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 31/05/2016
 * Time: 10:47
 */

function GetNotesFromEtudiant($idEtudiant){
    global $bdd;
    $req = $bdd->prepare('SELECT ID_Epreuve,ID_Etudiant,Note_Finale,Note_Prevue,Absence_Epreuve FROM etudiantnote
WHERE etudiantnote.ID_Etudiant = :idEtudiant');
    $req->bindParam(':idEtudiant', $idEtudiant, PDO::PARAM_INT);
    $req->execute();
    $notesDb = $req->fetchAll();
    $notes =array();
    foreach ($notesDb as $note)
    {
        $notes[] = new EtudiantNote($note);
    }
    return $notes;
}

function GetNotesFromEpreuve($idEpreuve){

}