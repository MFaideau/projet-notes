<?php

// Les fonctions utilisées pour le calcul des moyennes se trouve dans ce fichier.
include_once (__DIR__ . '../../../controleurs/tab_request.php');

if (isset($_POST['action']) && isset($_POST['idComp'])) {
    if ($_POST['action'] == "getHistoComp") {
        $idCompetence = $_POST['idComp'];
        $noteEtudiantComp = GetTabNotesEtudiantsFromCompetence($idCompetence);
        $notesEchantillons = GetVarTabHistoBatons($noteEtudiantComp);
        echo json_encode($notesEchantillons);
        return;
    }
}

if (isset($_POST['action']) && isset($_POST['idCursus'])) {
    if ($_POST['action'] == "getHistoCursus") {
        $idCursus = $_POST['idCursus'];
        $noteEtudiantCursus = GetTabNotesEtudiantsFromCursus($idCursus);
        $notesEchantillons = GetVarTabHistoBatons($noteEtudiantCursus);
        echo json_encode($notesEchantillons);
        return;
    }
}

if (isset($_POST['action']) && isset($_POST['idCours'])) {
    if ($_POST['action'] == "getHistoCours") {
        $idCours = $_POST['idCours'];
        $noteEtudiantCours = GetTabNotesEtudiantsFromCours($idCours);
        $notesEchantillons = GetVarTabHistoBatons($noteEtudiantCours);
        echo json_encode($notesEchantillons);
        return;
    }
}

if (isset($_POST['action']) && isset($_POST['idEpreuve'])) {
    if ($_POST['action'] == "getHistoEpreuve") {
        $idEpreuve = $_POST['$idEpreuve'];
        $noteEtudiantEpreuve = GetTabNotesEtudiantsFromEpreuve($idEpreuve);
        $notesEchantillons = GetVarTabHistoBatons($noteEtudiantEpreuve);
        return;
    }
}