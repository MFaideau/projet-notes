<?php
session_start();

include_once __DIR__ . '../../modeles/sqlConnection.php';
include_once __DIR__ . '../../modeles/authentification/utilisateur.class.php';
include_once __DIR__ . '../../modeles/cursus/cursus.php';
include_once __DIR__ . '../../modeles/type_evaluation/typeeval.php';

if (!isset($_SESSION['user'])) { die(); }
else {
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
            <div class="panel-heading">Choix de la Compétence</div>
            <div class="panel-body">
                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                    <?php
                    foreach ($cursus->GetCompetenceList() as $competence) { ?>
                        <div class="btn-group" role="group">
                            <button id="competence_<?php echo $competence->GetId(); ?>" type="button"
                                    class="btn btn-default"><?php echo html_entity_decode($competence->GetNom()); ?></button>
                        </div>
                    <?php } ?>
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
            <div class="panel-heading">Choix du Cours</div>
            <div class="panel-body">
                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                    <?php
                    foreach ($cours as $current_cours) { ?>
                        <div class="btn-group" role="group">
                            <button id="cours_<?php echo $current_cours->GetId(); ?>" type="button"
                                    class="btn btn-default"><?php echo html_entity_decode($current_cours->GetNom()); ?></button>
                        </div>
                    <?php } ?>
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
            <div class="panel-heading">Choix du Type d'Evaluation</div>
            <div class="panel-body">
                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                    <?php
                    foreach ($typeEvalList as $typeEval) { ?>
                        <div class="btn-group" role="group">
                            <button id="type_eval_<?php echo $typeEval->GetId(); ?>" type="button"
                                    class="btn btn-default"><?php echo html_entity_decode($typeEval->GetNom()); ?></button>
                        </div>
                    <?php } ?>
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
            <div class="panel-heading">Choix de l'Epreuve</div>
            <div class="panel-body">
                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                    <?php
                    foreach ($epreuveList as $epreuve) { ?>
                        <div class="btn-group" role="group">
                            <button id="epreuve_<?php echo $epreuve->GetId(); ?>" type="button"
                                    class="btn btn-default"><?php echo html_entity_decode($epreuve->GetNom()); ?></button>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

