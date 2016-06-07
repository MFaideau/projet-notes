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

if (isset($_POST['action']) && isset($_POST['idTypeEval'])) {
    if ($_POST['action'] == "infos") {
        $idTypeEval = $_POST['idTypeEval'];
        $listEpreuves = GetEpreuveListFromTypeEval($idTypeEval);
        if (isset($listEpreuves))
            echo json_encode($listEpreuves);
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

if (isset($_POST['action']) && isset($_POST['idEval']) && empty($_POST['idCours']) && empty($_POST['nomTypeEval']))
    if ($_POST['action'] == "delete")
        DeleteEval($_POST['idEval']);

if (isset($_POST['idTypeEval']) && empty($_POST['nomEpreuve'])) {
    $idTypeEval = $_POST['idTypeEval'];
    $epreuveList = GetEpreuveListFromTypeEval($idTypeEval);
    if (!isset($epreuveList)) return;
    else
        include_once __DIR__ . '../../../vues/admin/ajax/organisation/epreuves_bloc.php';
}


if (isset($_POST['action']) && isset($_POST['idTypeEval']) && empty($_POST['nomEpreuve']))
    if ($_POST['action'] == "delete")
        DeleteTypeEval($_POST['idTypeEval']);

// On gère la créations des nouveaux éléments des études (cursus / compétences / cours / ...
if ((isset($_POST['nomCursus'])) && isset($_POST['anneeCursus'])) {
    if ((!empty($_POST['nomCursus'])) && !empty($_POST['anneeCursus'])) {
        $idCursusNew = InsertCursus($_POST['nomCursus'], $_POST['anneeCursus']);
        include_once __DIR__ . '../../../vues/admin/ajax/organisation/new_cursus_bloc.php';
    }
}
if ((!empty($_POST['nomCompetence'])) && !empty($_POST['idCursus'])) {
    InsertCompetence($_POST['nomCompetence'], $_POST['idCursus']);
}
if ((isset($_POST['nomCours'])) && isset($_POST['nbCreditsCours']) && isset($_POST['semestreCours']) && isset($_POST['idCompetence'])) {
    InsertCours($_POST['nomCours'], $_POST['nbCreditsCours'], $_POST['semestreCours'], $_POST['idCompetence']);
}
if (isset($_POST['idCours']) && isset($_POST['nomEval']) && isset($_POST['coefEval'])) {
    InsertEvaluation($_POST['nomEval'], $_POST['coefEval'], $_POST['idCours']);
}
if (isset($_POST['idEval']) && isset($_POST['nomTypeEval']) && isset($_POST['coefTypeEval']))
    $idTypeEvalNew = InsertTypeEval($_POST['nomTypeEval'], $_POST['coefTypeEval'], $_POST['idEval']);

if (isset($_POST['nomEpreuve']) && isset($_POST['coefEpreuve']) && isset($_POST['dateEpreuve']) && isset($_POST['evaluateurEpreuve']) && isset($_POST['idEpreuveSubstitution']) && isset($_POST['idSecondeSession']) && isset($_POST['idTypeEval'])) {
    echo var_dump($_POST);
    $idEpreuveNew = InsertEpreuve($_POST['nomEpreuve'], $_POST['coefEpreuve'], $_POST['dateEpreuve'], $_POST['evaluateurEpreuve'], $_POST['idEpreuveSubstitution'], $_POST['idSecondeSession'], $_POST['idTypeEval']);
  }

?>