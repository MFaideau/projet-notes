<?php
define("ROOT_ACCESS",true);
session_start();

include_once __DIR__ . '../../modeles/sqlConnection.php';
include_once __DIR__ . '../../modeles/authentification/utilisateur.class.php';
include_once __DIR__ . '../../modeles/cursus/cursus.php';
include_once __DIR__ . '../../modeles/type_evaluation/typeeval.php';
include_once __DIR__ . '../../modeles/cursus/cursus.php';

if (!isset($_SESSION['user']))
    die();

$user = unserialize($_SESSION['user']);
$etudiant = GetEtudiant($user);
if(isset($etudiant))
    $idEtudiant = $etudiant->GetId();

include_once __DIR__ . '../../controleurs/tab_request.php';
include_once __DIR__ . '../../controleurs/ajax/calculSimulation.php';
