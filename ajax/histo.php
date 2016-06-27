<?php
define("ROOT_ACCESS",true);
session_start();

// On fait les vérifications nécessaires pour protéger le panneau admin des requêtes AJAX
if (!isset($_SESSION['user'])) {
    die();
}

include_once __DIR__ . '../../modeles/sqlConnection.php';
include_once __DIR__ . '../../modeles/authentification/utilisateur.class.php';
/*include_once __DIR__ . '../../modeles/cursus/cursus.php';
include_once __DIR__ . '../../modeles/type_evaluation/typeeval.php';
include_once __DIR__ . '../../modeles/etudiantnote/etudiantnote.php';
*/
$user = unserialize($_SESSION['user']);
// On gère le cas où c'est un admin qui visualise un étudiant
if(isset($_SESSION['user_vue']) && $user->GetAutorite() != 0) {
    $user_vue = unserialize($_SESSION['user_vue']);
    if (isset($user_vue))
        $etudiant = GetEtudiant($user_vue);
}
else
    $etudiant = GetEtudiant($user);

// TODO : faire un tri dans le dossier ajax et le mettre dans le controleur
$cursus = $etudiant->GetCursus();
$idEtudiant = $etudiant->GetId();

if(!isset($cursus))
    die();

include_once __DIR__ . '../../controleurs/tab_request.php';
include_once __DIR__ . '../../controleurs/ajax/histo.php';