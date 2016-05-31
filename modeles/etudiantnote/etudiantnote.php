<?php
/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 31/05/2016
 * Time: 10:47
 */
function GetNotesFromEpreuve($idEpreuve)
{
    //Pas sûr que ça soit utile après tout...
    global $bdd;
    $req = $bdd->prepare('SELECT Note_Finale FROM etudiantnote WHERE etudiantnote.ID_Epreuve = :idEpreuve');
    $req->bindParam(':idEpereuve', $idEpreuve, PDO::PARAM_INT);
    $req->execute();
    $notesDb = $req->fetchAll();
    $notes =array();
    foreach ($notesDb as $note)
    {
        $notes[] = $note;
    }
    return $notes;
}

function GetEtudiantNoteFromEtudiantEpreuve($idEtudiant,$idEpreuve)
{
    global $bdd;
    $req = $bdd->prepare('SELECT ID_Epreuve,ID_Etudiant,Note_Finale,Note_Prevue,Absence_Epreuve FROM etudiantnote
WHERE etudiantnote.ID_Etudiant = :idEtudiant AND etudiantnote.ID_Epreuve = :idEpreuve');
    $req->bindParam(':idEtudiant', $idEtudiant, PDO::PARAM_INT);
    $req->bindParam(':idEpreuve', $idEpreuve, PDO::PARAM_INT);
    $req->execute();
    $notesDb = $req->fetchAll();
    if (count($notesDb)>0)
    { //Correspondance entre étudiant et épreuve trouvée (note trouvée)...
        return $notesDb[0];
    }
    else
    {
        //...Ou pas
        return null;
    }
}
function GetEtudiantNotesFromEtudiant($idEtudiant){
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
function GetEtudiantNotesFromEpreuve($idEpreuve){
    global $bdd;
    $req = $bdd->prepare('SELECT ID_Epreuve,ID_Etudiant,Note_Finale,Note_Prevue,Absence_Epreuve FROM etudiantnote
WHERE etudiantnote.ID_Epreuve = :idEpreuve');
    $req->bindParam(':idEpereuve', $idEpreuve, PDO::PARAM_INT);
    $req->execute();
    $notesDb = $req->fetchAll();
    $notes =array();
    foreach ($notesDb as $note)
    {
        $notes[] = new EtudiantNote($note);
    }
    return $notes;
}