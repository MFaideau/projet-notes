<?php
/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 31/05/2016
 * Time: 10:47
 */
include_once(__DIR__ . '../../../modeles/etudiantnote/etudiantnote.class.php');

function GetEtudiantNoteFromEtudiantEpreuve($idEtudiant, $idEpreuve)
{ // RETOURNE UN OBJET ETUDIANTNOTE
    global $bdd;
    $req = $bdd->prepare('SELECT ID_Epreuve,ID_Etudiant,Note_Finale,Note_Prevue,Absence_Epreuve FROM etudiantnote
WHERE etudiantnote.ID_Etudiant = :idEtudiant AND etudiantnote.ID_Epreuve = :idEpreuve');
    $req->bindParam(':idEtudiant', $idEtudiant, PDO::PARAM_INT);
    $req->bindParam(':idEpreuve', $idEpreuve, PDO::PARAM_INT);
    $req->execute();
    $notesDb = $req->fetchAll();
    if (count($notesDb) > 0) { //Correspondance entre étudiant et épreuve trouvée (note trouvée)...
        return new EtudiantNote($notesDb[0]);
    } else {
        //...Ou pas
        return null;
    }
}

function GetEtudiantNotesFromEtudiant($idEtudiant)
{
    // RETOURNE UNE LISTE D'OBJETS ETUDIANTNOTE
    global $bdd;
    $req = $bdd->prepare('SELECT ID_Epreuve,ID_Etudiant,Note_Finale,Note_Prevue,Absence_Epreuve FROM etudiantnote
WHERE etudiantnote.ID_Etudiant = :idEtudiant');
    $req->bindParam(':idEtudiant', $idEtudiant, PDO::PARAM_INT);
    $req->execute();
    $notesDb = $req->fetchAll();
    $notes = array();
    foreach ($notesDb as $note) {
        $notes[] = new EtudiantNote($note);
    }
    return $notes;
}

function GetEtudiantNotesFromEpreuve($idEpreuve)
{
    // RETOURNE UNE LISTE D'OBJETS ETUDIANTNOTE
    global $bdd;
    $req = $bdd->prepare('SELECT ID_Epreuve,ID_Etudiant,Note_Finale,Note_Prevue,Absence_Epreuve FROM etudiantnote
WHERE etudiantnote.ID_Epreuve = :idEpreuve');
    $req->bindParam(':idEpreuve', $idEpreuve, PDO::PARAM_INT);
    $req->execute();
    $notesDb = $req->fetchAll();
    $notes = array();
    foreach ($notesDb as $note) {
        $notes[] = new EtudiantNote($note);
    }
    return $notes;
}

function EtudiantNoteExists($idEpreuve, $idEtudiant)
{
    global $bdd;
    $req = $bdd->prepare('SELECT count(ID_Epreuve) FROM etudiantnote
WHERE ID_Epreuve = :idEpreuve AND ID_Etudiant = :idEtudiant');
    $req->bindParam(':idEpreuve', $idEpreuve, PDO::PARAM_INT);
    $req->bindParam(':idEtudiant', $idEtudiant, PDO::PARAM_INT);
    $req->execute();
    $matchCount = $req->fetch();
    if ($matchCount['count(ID_Epreuve)'] > 0)
        return true;
    else
        return false;
}

function AddEtudiantNotePrevue($idEpreuve, $idEtudiant, $notePrevue)
{
    global $bdd;
    if (EtudiantNoteExists($idEpreuve, $idEtudiant))
    {
        $req = $bdd->prepare('UPDATE etudiantnote SET Note_Finale = :noteFinale,Note_Prevue = :notePrevue,Absence_Epreuve=:absence 
WHERE ID_Epreuve = :idEpreuve AND ID_Etudiant = :idEtudiant');
        $req->execute(array(
            'idEpreuve' => $idEpreuve,
            'idEtudiant' => $idEtudiant,
            'noteFinale' => -1,
            'notePrevue' => $notePrevue,
            'absence' => 0,
        ));
    }
    else
    {
        $req = $bdd->prepare('INSERT INTO etudiantnote (ID_Epreuve,ID_Etudiant,Note_Finale,Note_Prevue,Absence_Epreuve) 
VALUES (:idEpreuve,:idEtudiant,:noteFinale,:notePrevue,:absenceEpreuve)');
        $req->execute(array(
            'idEpreuve' => $idEpreuve,
            'idEtudiant' => $idEtudiant,
            'noteFinale' => -1,
            'notePrevue' =>  $notePrevue,
            'absenceEpreuve' => 0,
        ));
        return;
    }
}

function InsertEtudiantNoteFull($data)
{
    global $bdd;
    $req = $bdd->prepare('INSERT INTO etudiantnote (ID_Epreuve,ID_Etudiant,Note_Finale,Note_Prevue,Absence_Epreuve) VALUES (:idEpreuve,:idEtudiant,:noteFinale,:notePrevue,:absence)');
    $req->bindParam(':idEpreuve', $data[0], PDO::PARAM_INT);
    $req->bindParam(':idEtudiant', $data[1], PDO::PARAM_INT);
    $req->bindParam(':noteFinale', $data[2], PDO::PARAM_STR);
    $req->bindParam(':notePrevue', $data[3], PDO::PARAM_STR);
    $req->bindParam(':absence', $data[4], PDO::PARAM_INT);
    $req->execute();
}

function AddEtudiantNote($idEpreuve, $idEtudiant, $noteEtudiant, $absence)
{
    global $bdd;
    if (EtudiantNoteExists($idEpreuve, $idEtudiant))
    {
        $req = $bdd->prepare('UPDATE etudiantnote SET Note_Finale = :noteFinale,Note_Prevue = :notePrevue,Absence_Epreuve=:absence 
WHERE ID_Epreuve = :idEpreuve AND ID_Etudiant = :idEtudiant');
        $result =  $req->execute(array(
            'idEpreuve' => $idEpreuve,
            'idEtudiant' => $idEtudiant,
            'noteFinale' => $noteEtudiant,
            'notePrevue' => $noteEtudiant,
            'absence' => $absence,
        ));
    }
    else
    {
        $req = $bdd->prepare('INSERT INTO etudiantnote (ID_Epreuve,ID_Etudiant,Note_Finale,Note_Prevue,Absence_Epreuve) 
VALUES (:idEpreuve,:idEtudiant,:noteFinale,:notePrevue,:absenceEpreuve)');
    $result = $req->execute(array(
        'idEpreuve' => $idEpreuve,
        'idEtudiant' => $idEtudiant,
        'noteFinale' => $noteEtudiant,
        'notePrevue' =>  $noteEtudiant,
        'absenceEpreuve' => $absence,
    ));
    }
    return $result;
}

function GetContentEtudiantNote($idCursus) {
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM etudiantnote,etudiant WHERE etudiantnote.ID_Etudiant = etudiant.ID_Etudiant AND etudiant.ID_Cursus=:idCursus');
    $req->bindParam(':idCursus', $idCursus, PDO::PARAM_INT);
    $req->execute();
    $result=$req->fetchAll();
    $str="etudiantnote"."\r\n";
    $str =$str.count($result)."\r\n";
    //$str=$str."ID_Epreuve;ID_Etudiant;Note_Finale;Note_Prevue;Absence_Epreuve"."\r\n";
    foreach ($result as $line){
        $str=$str.$line["ID_Epreuve"].";";
        $str=$str.$line["ID_Etudiant"].";";
        $str=$str.$line["Note_Finale"].";";
        $str=$str.$line["Note_Prevue"].";";
        $str=$str.$line["Absence_Epreuve"]."\r\n";
    }
    return $str;
}