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
if (isset($_POST['idCompetence']) && empty($_POST['nomCours'])) {
    $idCompetence = $_POST['idCompetence'];
    $cours = GetCoursListFromCompetence($idCompetence);
    if (!isset($cours)) return;
    else {
        include_once __DIR__ . '../../../vues/admin/ajax/organisation/cours_bloc.php';
    }
}
if (isset($_POST['idCours']) && empty($_POST['nomEval'])) {
    $idCours = $_POST['idCours'];
    $eval = GetEvalListFromCours($idCours);
    if (!isset($eval)) return;
    else
        include_once __DIR__ . '../../../vues/admin/ajax/organisation/eval_bloc.php';
}
if (isset($_POST['idEval']) && empty($_POST['idCours']) && empty($_POST['nomTypeEval'])) {
    $idEval = $_POST['idEval'];
    $typeEvalList = GetTypeEvalListFromEval($idEval);
    if (!isset($typeEvalList)) return;
    else {
        include_once __DIR__ . '../../../vues/admin/ajax/organisation/types_eval_bloc.php';
    }
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
if ((isset($_POST['nomCours'])) && isset($_POST['nbCreditsCours']) && isset($_POST['semestreCours']) && isset($_POST['idCompetence'])) {
    $idCoursNew = InsertCours($_POST['nomCours'],$_POST['nbCreditsCours'],$_POST['semestreCours'],$_POST['idCompetence']);
    include_once __DIR__ . '../../../vues/admin/ajax/organisation/new_cours_bloc.php';
}
if (isset($_POST['idCours']) && isset($_POST['nomEval']) && isset($_POST['coefEval'])) {
    $idEvalNew = InsertEvaluation($_POST['nomEval'],$_POST['coefEval'], $_POST['idCours']);
    include_once __DIR__ . '../../../vues/admin/ajax/organisation/new_eval_bloc.php';
}
if (isset($_POST['idEval']) && isset($_POST['nomTypeEval']) && isset($_POST['coefTypeEval'])) {
    $idTypeEvalNew = InsertTypeEval($_POST['nomTypeEval'], $_POST['coefTypeEval'], $_POST['idEval'] );
    echo var_dump($_POST);
    include_once __DIR__ . '../../../vues/admin/ajax/organisation/new_type_eval_bloc.php';
}



?>