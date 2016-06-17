<?php
defined("ROOT_ACCESS") or die();
$utilisateur = unserialize($_SESSION['user']);
if ($utilisateur->GetAutorite() == 0) {
    die();
}

$user = serialize($_SESSION['user']);

if (isset($_POST['idCursus'])) {
    $idCursus = $_POST['idCursus'];
    $cursus = GetCursus(GetCursusList(), $idCursus);
    if (empty($cursus)) return;
    else
        include_once __DIR__ . '../../../vues/admin/ajax/saisie/competences_bloc.php';
}
if (isset($_POST['idCompetence'])) {
    $idCompetence = $_POST['idCompetence'];
    $cours = GetCoursListFromCompetence($idCompetence);
    if (empty($cours)) return;
    else
        include_once __DIR__ . '../../../vues/admin/ajax/saisie/cours_bloc.php';
}
if (isset($_POST['idCours'])) {
    $idCours = $_POST['idCours'];
    $typeEvalList = GetTypeEvalListFromCours($idCours);
    if (empty($typeEvalList)) return;
    else
        include_once __DIR__ . '../../../vues/admin/ajax/saisie/types_eval_bloc.php';
}
if (isset($_POST['idTypeEval'])) {
    $idTypeEval = $_POST['idTypeEval'];
    $epreuveList = GetEpreuveListFromTypeEval($idTypeEval);
    if (empty($epreuveList)) return;
    else
        include_once __DIR__ . '../../../vues/admin/ajax/saisie/epreuves_bloc.php';
}
if (isset($_POST['idEpreuve'])) {
    $idUploadEval = $_POST['idEpreuve'];
    if (empty($idUploadEval)) return;
    else
        include_once __DIR__ . '../../../vues/admin/ajax/saisie/upload_bloc.php';
}
?>