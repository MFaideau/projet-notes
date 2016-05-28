<?php
session_start();

include_once __DIR__ . '../../modeles/sqlConnection.php';
include_once __DIR__ . '../../modeles/authentification/utilisateur.class.php';
include_once __DIR__ . '../../modeles/cursus/cursus.php';
include_once __DIR__ . '../../modeles/type_evaluation/typeeval.php';

if (!isset($_SESSION['user'])) {
    die();
} else {
    $utilisateur = unserialize($_SESSION['user']);
    if ($utilisateur->GetAutorite() != 1) {
        die();
    }
}

$user = serialize($_SESSION['user']);

if (isset($_POST['idCursus'])) {
    $idCursus = $_POST['idCursus'];
    $cursus = GetCursus(GetCursusList(), $idCursus);
    ?>
    <div class="panel_competences">
        <div class="panel panel-default saisie_notes">
            <div class="panel-heading">
                Choix de la Compétence
                <div class="add_button_etudes">
                    <a data-toggle="modal" data-target="#addCompetence">
                        <i class="glyphicon glyphicon-plus"></i>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="btn-group" role="group" aria-label="...">
                    <div class="btn-group" role="group">
                        <?php
                        foreach ($cursus->GetCompetenceList() as $competence) { ?>
                            <button id="orga_competence_<?php echo $competence->GetId(); ?>" type="button"
                                    class="btn btn-default btn-competences"><?php echo html_entity_decode($competence->GetNom()); ?></button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }
if (isset($_POST['idCompetence'])) {
    $idCompetence = $_POST['idCompetence'];
    $cours = GetCoursListFromCompetence($idCompetence);
    ?>
    <div class="panel_cours">
        <div class="panel panel-default saisie_notes">
            <div class="panel-heading">Choix du Cours
                <div class="add_button_etudes">
                    <a data-toggle="modal" data-target="#addCours">
                        <i class="glyphicon glyphicon-plus"></i>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="btn-group" role="group" aria-label="...">

                    <div class="btn-group" role="group">
                        <?php
                        foreach ($cours as $current_cours) { ?>
                            <button id="orga_cours_<?php echo $current_cours->GetId(); ?>" type="button"
                                    class="btn btn-default"><?php echo html_entity_decode($current_cours->GetNom()); ?></button>

                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }
if (isset($_POST['idCours'])) {
    $idCours = $_POST['idCours'];
    $typeEvalList = GetTypeEvalListFromCours($idCours);
    ?>
    <div class="panel_type_eval">
        <div class="panel panel-default saisie_notes">
            <div class="panel-heading">Choix du Type d'Evaluation
                <div class="add_button_etudes">
                    <a data-toggle="modal" data-target="#addTypeEval">
                        <i class="glyphicon glyphicon-plus"></i>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="btn-group" role="group" aria-label="...">
                    <div class="btn-group" role="group">
                        <?php
                        foreach ($typeEvalList as $typeEval) { ?>
                            <button id="orga_type_eval_<?php echo $typeEval->GetId(); ?>" type="button"
                                    class="btn btn-default"><?php echo html_entity_decode($typeEval->GetNom()); ?></button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }
if (isset($_POST['idTypeEval'])) {
    $idTypeEval = $_POST['idTypeEval'];
    $epreuveList = GetEpreuveListFromTypeEval($idTypeEval);
    ?>
    <div class="panel_epreuve">
        <div class="panel panel-default saisie_notes">
            <div class="panel-heading">Choix de l'Epreuve
                <div class="add_button_etudes">
                    <a data-toggle="modal" data-target="#addEpreuve">
                        <i class="glyphicon glyphicon-plus"></i>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="btn-group" role="group" aria-label="...">

                    <div class="btn-group" role="group">
                        <?php
                        foreach ($epreuveList as $epreuve) { ?>
                            <button id="orga_epreuve_<?php echo $epreuve->GetId(); ?>" type="button"
                                    class="btn btn-default"><?php echo html_entity_decode($epreuve->GetNom()); ?></button>

                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }

if (isset($_POST['nomCursus'])) {
    ?>
    <div class="btn-group" role="group">
        <button id="orga_cursus_<?php echo $_POST['nomCursus']; ?>" type="button"
                class="btn btn-default"><?php echo $_POST['nomCursus']; ?></button>
    </div>
<?php }
?>