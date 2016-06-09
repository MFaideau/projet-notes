<?php

$utilisateur = unserialize($_SESSION['user']);
if ($utilisateur->GetAutorite() != 1) {
    die();
}

// Création du menu en dynamique
$user = serialize($_SESSION['user']);

// S'il n'y a que l'idCursus qui est rempli, on crée un nouveau cursus
if (!isset($_POST['action']) && isset($_POST['idCursus']) && empty($_POST['nomCompetence'])) {
    $idCursus = $_POST['idCursus'];
    $cursus = GetCursus(GetCursusList(), $idCursus);
    if (!isset($cursus)) return;
    else
        include_once __DIR__ . '../../../vues/admin/ajax/organisation/competences_bloc.php';
}

// Pour le bloc des modifications des cursus
if (isset($_POST['action']) && isset($_POST['idCursus'])) {
    if ($_POST['action'] == "infos") {
        $idCursus = $_POST['idCursus'];
        $cursus = GetCursus(GetCursusList(), $idCursus);
        if (!isset($cursus)) return;
        else {
            echo json_encode($cursus);
            return;
        }
    }
}
if (isset($_POST['action']) && isset($_POST['idEval'])) {
    if ($_POST['action'] == "infos") {
        $idEval = $_POST['idEval'];
        $eval = GetEvalFromId($idEval);
        if (isset($eval))
            echo json_encode($eval);
        return;
    }
}
if (isset($_POST['action']) && isset($_POST['idTypeEval'])) {
    if ($_POST['action'] == "secondesession") {
        $idTypeEval = $_POST['idTypeEval'];
        $listEpreuves = GetEpreuveListFromTypeEval($idTypeEval);
        if (isset($listEpreuves))
            echo json_encode($listEpreuves);
        return;
    }
}
if (isset($_POST['action']) && isset($_POST['idTypeEval'])) {
    if ($_POST['action'] == "infos") {
        $idTypeEval = $_POST['idTypeEval'];
        $typeEval = GetTypeEvalFromId($idTypeEval);
        if (isset($typeEval))
            echo json_encode($typeEval);
        return;
    }
}
if (isset($_POST['action']) && isset($_POST['idEpreuve'])) {
    if ($_POST['action'] == "infos") {
        $idEpreuve = $_POST['idEpreuve'];
        $epreuve = GetEpreuveFromId($idEpreuve);
        if (isset($epreuve))
            echo json_encode($epreuve);
        return;
    }
}
if (isset($_POST['action']) && isset($_POST['idCours'])) {
    if ($_POST['action'] == "substitution") {
        $idCours = $_POST['idCours'];
        $listEpreuves = GetEpreuveListFromCours($idCours);
        if (isset($listEpreuves))
            echo json_encode($listEpreuves);
        return;
    }
}

// TODO : Faire une fenêtre de validation lors de la suppression du cursus
if (isset($_POST['action']) && isset($_POST['idCursus']) && empty($_POST['nomCompetence']))
    if ($_POST['action'] == "delete")
        DeleteCursus($_POST['idCursus']);

if (isset($_POST['idCompetence']) && empty($_POST['nomCours'])) {
    $idCompetence = $_POST['idCompetence'];
    $cours = GetCoursListFromCompetence($idCompetence);
    if (!isset($cours)) return;
    else
        include_once __DIR__ . '../../../vues/admin/ajax/organisation/cours_bloc.php';
}

if (isset($_POST['action']) && isset($_POST['idCompetence']) && empty($_POST['nomCours']))
    if ($_POST['action'] == "delete")
        DeleteCompetence($_POST['idCompetence']);

// Retourne le bloc avec la liste des évaluations
if (isset($_POST['idCours']) && empty($_POST['action']) && empty($_POST['nomEval'])) {
    $idCours = $_POST['idCours'];
    $eval = GetEvalListFromCours($idCours);
    if (!isset($eval)) return;
    else
        include_once __DIR__ . '../../../vues/admin/ajax/organisation/eval_bloc.php';
}

if (isset($_POST['action']) && isset($_POST['idCours']) && empty($_POST['nomTypeEval'])) {
    if ($_POST['action'] == "delete")
        DeleteCours($_POST['idCours']);
    if ($_POST['action'] == "infos") {
        echo json_encode(GetCoursById($_POST['idCours']));
        return;
    }
}

if (isset($_POST['idEval']) && empty($_POST['idCours']) && empty($_POST['nomTypeEval'])) {
    $idEval = $_POST['idEval'];
    $typeEvalList = GetTypeEvalListFromEval($idEval);
    if (!isset($typeEvalList)) return;
    else
        include_once __DIR__ . '../../../vues/admin/ajax/organisation/types_eval_bloc.php';
}

if (isset($_POST['action']) && isset($_POST['idEval']))
    if ($_POST['action'] == "delete")
        DeleteEval($_POST['idEval']);

if (isset($_POST['idTypeEval']) && empty($_POST['nomEpreuve'])) {
    $idTypeEval = $_POST['idTypeEval'];
    $epreuveList = GetEpreuveListFromTypeEval($idTypeEval);
    if (!isset($epreuveList)) return;
    else
        include_once __DIR__ . '../../../vues/admin/ajax/organisation/epreuves_bloc.php';
}
if (isset($_POST['action']) && isset($_POST['idTypeEval']))
    if ($_POST['action'] == "delete")
        DeleteTypeEval($_POST['idTypeEval']);

if (isset($_POST['action']) && isset($_POST['idEpreuve']))
    if ($_POST['action'] == "delete")
        DeleteEpreuve($_POST['idEpreuve']);

// On gère la créations des nouveaux éléments des études (cursus / compétences / cours / ...
if (isset($_POST['action']) && (isset($_POST['nomCursus'])) && isset($_POST['anneeCursus'])) {
    if ($_POST['action'] == "add")
        $idCursusNew = InsertCursus($_POST['nomCursus'], $_POST['anneeCursus']);
    include_once __DIR__ . '../../../vues/admin/ajax/organisation/new_cursus_bloc.php';
}
if (isset($_POST['action']) && (isset($_POST['nomCompetence'])) && isset($_POST['idCursus'])) {
    if ($_POST['action'] == "add")
        InsertCompetence($_POST['nomCompetence'], $_POST['idCursus']);
}
if (isset($_POST['action']) && (isset($_POST['nomCours'])) && isset($_POST['nbCreditsCours']) && isset($_POST['semestreCours']) && isset($_POST['idCompetence'])) {
    if ($_POST['action'] == "add")
        InsertCours($_POST['nomCours'], $_POST['nbCreditsCours'], $_POST['semestreCours'], $_POST['idCompetence']);
}
if (isset($_POST['action']) && isset($_POST['idCours']) && isset($_POST['nomEval']) && isset($_POST['coefEval'])) {
    if ($_POST['action'] == "add")
        InsertEvaluation($_POST['nomEval'], $_POST['coefEval'], $_POST['idCours']);
}
if (isset($_POST['action']) && isset($_POST['idEval']) && isset($_POST['nomTypeEval']) && isset($_POST['coefTypeEval']))
    if ($_POST['action'] == "add")
        $idTypeEvalNew = InsertTypeEval($_POST['nomTypeEval'], $_POST['coefTypeEval'], $_POST['idEval']);

if (isset($_POST['action']) && isset($_POST['nomEpreuve']) && isset($_POST['coefEpreuve']) && isset($_POST['dateEpreuve']) && isset($_POST['evaluateurEpreuve']) && isset($_POST['idEpreuveSubstitution']) && isset($_POST['idSecondeSession']) && isset($_POST['idTypeEval'])) {
    if ($_POST['action'] == "add")
        $idEpreuveNew = InsertEpreuve($_POST['nomEpreuve'], $_POST['coefEpreuve'], $_POST['dateEpreuve'], $_POST['evaluateurEpreuve'], $_POST['idEpreuveSubstitution'], $_POST['idSecondeSession'], $_POST['idTypeEval']);
}
if (isset($_POST['action']) && isset($_POST['idCursus']))
    if ($_POST['action'] == "modify" && isset($_POST['nomCursus']) && isset($_POST['anneeCursus']))
        ModifyCursus($_POST['idCursus'], $_POST['nomCursus'], $_POST['anneeCursus']);

if (isset($_POST['action']) && isset($_POST['idCompetence']))
    if ($_POST['action'] == "modify" && isset($_POST['nomCompetence']))
        ModifyCompetence($_POST['idCompetence'], $_POST['nomCompetence']);

if (isset($_POST['action']) && isset($_POST['idCours']))
    if ($_POST['action'] == "modify" && isset($_POST['nomCours']) && isset($_POST['creditsCours']) && isset($_POST['semestreCours']))
        ModifyCours($_POST['idCours'],$_POST['nomCours'],$_POST['creditsCours'], $_POST['semestreCours']);

if (isset($_POST['action']) && isset($_POST['idEval']))
    if ($_POST['action'] == "modify" && isset($_POST['nomEval']) && isset($_POST['coefEval']))
        ModifyEval($_POST['idEval'],$_POST['nomEval'],$_POST['coefEval']);

if (isset($_POST['action']) && isset($_POST['idTypeEval']))
    if ($_POST['action'] == "modify" && isset($_POST['nomTypeEval']) && isset($_POST['coefTypeEval']))
        ModifyTypeEval($_POST['idTypeEval'],$_POST['nomTypeEval'],$_POST['coefTypeEval']);

if (isset($_POST['action']) && isset($_POST['idEpreuve']))
    if ($_POST['action'] == "modify" && isset($_POST['nomEpreuve']) && isset($_POST['coefEpreuve']) && isset($_POST['dateEpreuve']) && isset($_POST['evaluateurEpreuve']) && isset($_POST['secondeSessionEpreuve']) && isset($_POST['substitutionEpreuve']))
        ModifyEpreuve($_POST['idEpreuve'],$_POST['nomEpreuve'],$_POST['coefEpreuve'],$_POST['dateEpreuve'],$_POST['evaluateurEpreuve'],$_POST['substitutionEpreuve'],$_POST['secondeSessionEpreuve']);


?>