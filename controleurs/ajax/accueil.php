<?php
include_once (__DIR__ . '../../tab_request.php');
include (__DIR__ . '../../../controleurs/controle_histo/tab_list.php');
include_once (__DIR__ . '../../../controleurs/controle_histo/tab_moyennes.php');
include_once (__DIR__ . '../../../modeles/authentification/utilisateur.class.php');

$user = unserialize($_SESSION['user']);
$cursus = GetEtudiant($user)->GetCursus();
$competenceList = GetCompetenceListFromCursus($cursus->GetId());

if(!isset($cursus))
    die();

if(isset($_POST['button'])) {
    if($_POST['button'] == "tableaux") {
        include_once __DIR__ . '../../../vues/ajax/tableaux_bloc.php';
    }
}
if(isset($_POST['button'])) {
    if($_POST['button'] == "histog")
        include_once __DIR__ . '../../../vues/ajax/histo_bloc.php';
}
if(isset($_POST['button'])) {
    if($_POST['button'] == "batons") {
        include_once __DIR__ . '../../../vues/ajax/batons_bloc.php';
    }
}