<?php

$utilisateur = unserialize($_SESSION['user']);
if ($utilisateur->GetAutorite() != 1) {
    die();
}

// Création du menu en dynamique
$user = serialize($_SESSION['user']);

if (isset($_POST['idCursus'])) {
    $idCursus = $_POST['idCursus'];
    $cursus = GetCursus(GetCursusList(), $idCursus);
    if (empty($cursus)) return;
    else
        include_once __DIR__ . '../../../vues/admin/ajax/organisation/competences_bloc.php';

}
if (isset($_POST['idCompetence'])) {
    $idCompetence = $_POST['idCompetence'];
    $cours = GetCoursListFromCompetence($idCompetence);
    if (empty($cours)) return;
    else
        include_once __DIR__ . '../../../vues/admin/ajax/organisation/cours_bloc.php';
}
if (isset($_POST['idCours'])) {
    $idCours = $_POST['idCours'];
    $typeEvalList = GetTypeEvalListFromCours($idCours);
    if (empty($typeEvalList)) return;
    else
        include_once __DIR__ . '../../../vues/admin/ajax/organisation/types_eval_bloc.php';

}
if (isset($_POST['idTypeEval'])) {
    $idTypeEval = $_POST['idTypeEval'];
    $epreuveList = GetEpreuveListFromTypeEval($idTypeEval);
    if (empty($epreuveList)) return;
    else
        include_once __DIR__ . '../../../vues/admin/ajax/organisation/epreuves_bloc.php';

}

// On gère la créations des nouveaux éléments des études (cursus / compétences / cours / ...)
if (isset($_POST['nomCursus']))
    include_once __DIR__ . '../../../vues/admin/ajax/organisation/new_cursus_bloc.php';

?>