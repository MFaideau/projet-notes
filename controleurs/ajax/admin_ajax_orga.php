<?php

$utilisateur = unserialize($_SESSION['user']);
if ($utilisateur->GetAutorite() != 1) {
    die();
}

// Création du menu en dynamique
$user = serialize($_SESSION['user']);

// S'il n'y a que l'idCursus qui est rempli, on crée un nouveau cursus
if (isset($_POST['idCursus']) && empty($_POST['nomCompetence'])) {
    $idCursus = $_POST['idCursus'];
    $cursus = GetCursus(GetCursusList(), $idCursus);
    if (!isset($cursus)) return;
    else
        include_once __DIR__ . '../../../vues/admin/ajax/organisation/competences_bloc.php';

}
if (isset($_POST['idCompetence'])) {
    $idCompetence = $_POST['idCompetence'];
    $cours = GetCoursListFromCompetence($idCompetence);
    if (!isset($cours)) return;
    else {
        include_once __DIR__ . '../../../vues/admin/ajax/organisation/cours_bloc.php';
    }
}
if (isset($_POST['idCours'])) {
    $idCours = $_POST['idCours'];
    $typeEvalList = GetTypeEvalListFromCours($idCours);
    if (!isset($typeEvalList)) return;
    else
        include_once __DIR__ . '../../../vues/admin/ajax/organisation/types_eval_bloc.php';

}
if (isset($_POST['idTypeEval'])) {
    $idTypeEval = $_POST['idTypeEval'];
    $epreuveList = GetEpreuveListFromTypeEval($idTypeEval);
    if (!isset($epreuveList)) return;
    else
        include_once __DIR__ . '../../../vues/admin/ajax/organisation/epreuves_bloc.php';

}

// On gère la créations des nouveaux éléments des études (cursus / compétences / cours / ...)
if ((isset($_POST['nomCursus'])) && isset($_POST['anneeCursus'])) {
    if ((!empty($_POST['nomCursus'])) && !empty($_POST['anneeCursus'])) {
        $idCursusNew = InsertCursus($_POST['nomCursus'], $_POST['anneeCursus']);
        include_once __DIR__ . '../../../vues/admin/ajax/organisation/new_cursus_bloc.php';
    }
}

if ((!empty($_POST['nomCompetence'])) && !empty($_POST['idCursus'])) {
    $idCompetenceNew = InsertCompetence($_POST['nomCompetence'], $_POST['idCursus']);
    include_once __DIR__ . '../../../vues/admin/ajax/organisation/new_competence_bloc.php';
}

?>